<?php

namespace App\Services;

use App\Models\Debt;
use App\Models\Expense;
use App\Models\ExpenseCategory;
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
    }//end __construct()


    /**
     * CALCULATE TOTAL EXPENSES
     *
     * @return float TOTAL EXPENSE AMOUNT
     */
    public function calculateTotalExpenses(): float
    {
        return $this->expenseModel->sum('amount');
    }//end calculateTotalExpenses()


    /**
     * GET EXPENSES BY CATEGORY
     *
     * @param  string $category CATEGORY NAME
     * @return \Illuminate\Database\Eloquent\Collection LIST OF EXPENSES IN THE GIVEN CATEGORY
     */
    public function getExpensesByCategory(string $category)
    {
        return $this->expenseModel->where('category', $category)->get();
    }//end getExpensesByCategory()


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
            // Create the expense
            $expense = $this->expenseModel->create([
                'user_id'             => $data['user_id'],
                'expense_category_id' => $data['expense_category_id'],
                'total_amount'        => $data['total_amount'],
                'description'         => $data['description'] ?? null,
                'paid_at'             => $data['paid_at'],
            ]);

            // Get all participants (payers + shared_with)
            $allParticipants = array_unique(array_merge(
                $data['paid_by'],
                $data['shared_with']
            ));

            $sharePerPerson = $data['total_amount'] / count($allParticipants);

            // Attach all participants first with their shares
            foreach ($allParticipants as $userId) {
                $expense->participants()->attach($userId, [
                    'role'   => in_array($userId, $data['paid_by']) ? 'payer' : 'participant',
                    'amount' => $sharePerPerson,
                ]);
            }

            // Attach actual payments from payers
            foreach ($data['paid_by'] as $userId) {
                $expense->participants()->updateExistingPivot($userId, [
                    'amount_paid' => $data['paid_amounts'][$userId] ?? 0,
                ]);
            }

            // Calculate net debts
            $this->calculateNetDebts($expense, $sharePerPerson);

            return $expense;
        });
    }//end createExpense()


    protected function calculateNetDebts(Expense $expense, float $sharePerPerson): void
    {
        $participants = $expense->participants()->withPivot(['amount_paid', 'amount'])->get();

        // Calculate net balances
        $balances = [];
        foreach ($participants as $participant) {
            $paid = $participant->pivot->amount_paid ?? 0;
            $balances[$participant->id] = $paid - $sharePerPerson;
        }

        // Create debts only for net amounts
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
                            ]);

                            // Update balances
                            $balances[$borrowerId] += $amount;
                            $balances[$lenderId]   -= $amount;
                        }
                    }
                }
            }
        }//end foreach
    }//end calculateNetDebts()


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
            return $expense->delete();
        }

        return false;
    }//end deleteExpense()


    /**
     * Fetches all the categories from the database.
     *
     * @return array
     */
    public function getAllCategories(): array
    {
        return $this->expenseCategory->whereNull('deleted_at')->get()->toArray();
    }//end getAllCategories()


    /**
     * Fetches all the expenses with participants.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllExpensesWithParticipants()
    {
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
        ])->latest()->paginate(10);
    }//end getAllExpensesWithParticipants()


}//end class
