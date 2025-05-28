<?php

namespace App\Services;

use App\Models\Debt;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseParticipant;
use DB;

/**
 * ExpenseService
 */
class ExpenseService
{

    /**
     *  MODEL INSTANCE FOR EXPENSE
     *
     * @var Expense
     */
    protected Expense $expenseModel;

    /**
     *  MODEL INSTANCE FOR EXPENSE CATEGORY
     *
     * @var mixed
     */
    protected $expenseCategory;


    /**
     * CONSTRUCTOR TO BIND DEPENDENCIES
     *
     * @param Expense         $expense
     * @param ExpenseCategory $expenseCategory
     *
     * @return void
     */
    public function __construct(Expense $expense, ExpenseCategory $expenseCategory)
    {
        $this->expenseModel    = $expense;
        $this->expenseCategory = $expenseCategory;
    } //end __construct()


    /**
     * CALCULATE TOTAL EXPENSES
     *
     * @return float TOTAL EXPENSE AMOUNT
     */
    public function calculateTotalExpenses(): float
    {
        return $this->expenseModel->sum('amount');
    } //end calculateTotalExpenses()


    /**
     * GET EXPENSES BY CATEGORY
     *
     * @param  string $category CATEGORY NAME
     * @return \Illuminate\Database\Eloquent\Collection LIST OF EXPENSES IN THE GIVEN CATEGORY
     */
    public function getExpensesByCategory(string $category)
    {
        return $this->expenseModel->where('category', $category)->get();
    } //end getExpensesByCategory()


    /**
     * Create a new expense with precise payment amounts and debt tracking
     *
     * @param  array $data Array [
     *                     'user_id' => int,
     *                     'expense_category_id' => int,
     *                     'total_amount' => float,
     *                     'description' => string,
     *                     'paid_at' => DateTime,
     *                     'paid_by' => array[int],       // User IDs who paid
     *                     'paid_amounts' => array[int => float], // [user_id => amount_paid]
     *                     'shared_with' => array[int]    // User IDs who share the expense
     *                     ]
     * @return Expense
     */
    public function createExpense(array $data): Expense
    {
        return DB::transaction(function () use ($data) {
            $expense = $this->expenseModel->create([
                'user_id'             => $data['user_id'],
                'expense_category_id' => $data['expense_category_id'],
                'total_amount'        => $data['total_amount'],
                'description'         => $data['description'] ?? null,
                'paid_at'             => $data['paid_at'],
            ]);

            // Get only participants who should share the cost (not excluded)
            $sharingParticipants = array_filter($data['total_people'], function ($person) {
                return !$person['exclude_from_share'];
            });

            $sharePerPerson = $data['total_amount'] / count($sharingParticipants);

            // Attach all participants
            foreach ($data['total_people'] as $participant) {
                $expense->participants()->attach($participant['user_id'], [
                    'role'               => $participant['role'],
                    'amount'             => $participant['exclude_from_share'] ? 0 : $sharePerPerson,
                    'amount_paid'        => $participant['role'] === 'payer' ? $participant['amount'] : 0,
                    'exclude_from_share' => $participant['exclude_from_share'],
                ]);
            }

            $this->calculateNetDebts($expense, $sharePerPerson, false);
            return $expense;
        });
    } //end createExpense()


    /**
     * Calculate Net Debts.
     *
     * @param  Expense $expense
     * @param  float   $sharePerPerson
     * @param  boolean $isSettled
     * @return void
     */
    protected function calculateNetDebts(Expense $expense, float $sharePerPerson, ?bool $isSettled): void
    {
        $participants = $expense->participants()->withPivot(['amount_paid', 'amount', 'exclude_from_share'])->get();

        $balances = [];

        // Calculate net balances (only for sharing participants)
        foreach ($participants as $participant) {
            if (!$participant->pivot->exclude_from_share) {
                $paid = $participant->pivot->amount_paid ?? 0;
                $balances[$participant->id] = $paid - $sharePerPerson;
            } else {
                // For excluded payers, they only have what they paid
                $balances[$participant->id] = $participant->pivot->amount_paid ?? 0;
            }
        }

        // Create debts
        foreach ($balances as $borrowerId => $borrowerBalance) {
            if ($borrowerBalance < 0) {
                foreach ($balances as $lenderId => $lenderBalance) {
                    if ($lenderBalance > 0 && $borrowerBalance < 0) {
                        $amount = min(abs($borrowerBalance), $lenderBalance);

                        if ($amount > 0) {
                            Debt::create([
                                'expense_id'  => $expense->id,
                                'borrower_id' => $borrowerId,
                                'lender_id'   => $lenderId,
                                'amount'      => $amount,
                                'expense_date' => $expense->paid_at,
                                'is_settled'  => $isSettled??false,
                            ]);

                            // Update balances
                            $balances[$borrowerId] += $amount;
                            $balances[$lenderId]   -= $amount;
                        }
                    }
                }
            }
        } //end foreach
    } //end calculateNetDebts()


    /**
     * DELETE AN EXPENSE BY ID
     *
     * @param  integer $id EXPENSE ID.
     * @return boolean TRUE IF DELETED SUCCESSFULLY, FALSE OTHERWISE
     */
    public function deleteExpense(int $id): bool
    {
        $expense = $this->expenseModel->find($id);

        if ($expense) {
            $expParticipants = ExpenseParticipant::where('expense_id')->get();
            $expenseDebts    = Debt::where('expense_id', $expense->id)->get();
            foreach ($expParticipants as $key => $value) {
                $value->forceDelete();
            }

            foreach ($expenseDebts as $value) {
                $value->forceDelete();
            }

            return $expense->forceDelete();
        }

        return false;
    } //end deleteExpense()


    /**
     * Fetches all the categories from the database.
     *
     * @return array
     */
    public function getAllCategories(): array
    {
        return $this->expenseCategory->whereNull('deleted_at')->get()->toArray();
    } //end getAllCategories()


    /**
     * Fetches all the expenses with participants.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllExpensesWithParticipants()
    {
        $userId = auth()->id();

        return Expense::with([
                'expenseCategory',
                'payers' => function ($query) {
                    $query->withPivot('amount_paid', 'amount');
                },
                'participants' => function ($query) {
                    $query->withPivot('amount');
                },
                'unsettledDebts.lender',
                'unsettledDebts.borrower'
            ])
            ->whereHas('payers', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })
            ->orWhereHas('participants', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })
            ->latest()
            ->paginate(10);
    }


    /**
     * Update Expense
     *
     * @param  mixed $expense
     * @param  mixed $data
     * @return Expense
     */
    public function updateExpense(Expense $expense, array $data): Expense
    {
        return DB::transaction(function () use ($expense, $data) {
            // 1. First delete all existing debts for this expense
            Debt::where('expense_id', $expense->id)->delete();

            // 2. Update the expense details
            $expense->update(attributes: [
                'expense_category_id' => $data['expense_category_id'],
                'total_amount'        => $data['total_amount'],
                'description'         => $data['description'],
                'paid_at'             => $data['paid_at'],
            ]);

            // 3. Calculate new sharing logic
            $sharingParticipants = array_filter($data['total_people'], function ($person) {
                return !($person['exclude_from_share'] ?? false);
            });

            $sharePerPerson = $data['total_amount'] / max(1, count($sharingParticipants));

            // 4. Sync participants with updated amounts
            $participants = [];
            foreach ($data['total_people'] as $person) {
                $participants[$person['user_id']] = [
                    'role'               => $person['role'],
                    'amount'             => $person['exclude_from_share'] ?? false ? 0 : $sharePerPerson,
                    'amount_paid'        => $person['role'] === 'payer' ? ($person['amount'] ?? 0) : 0,
                    'exclude_from_share' => $person['exclude_from_share'] ?? false,
                ];
            }

            $expense->participants()->sync($participants);

            // 5. Calculate fresh debts (now without duplicates)
            $this->calculateNetDebts($expense, $sharePerPerson, $data['is_settled']);

            return $expense;
        });
    } //end updateExpense()


}//end class
