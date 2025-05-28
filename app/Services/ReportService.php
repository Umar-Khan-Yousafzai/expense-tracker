<?php

namespace App\Services;

use App\Models\User;
use App\Models\Debt;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ReportService
{
    public function generate(User $user, array $filters): array
    {
        $data = [
            'period'               => $this->getPeriodDescription($filters),
            'summary'              => $this->getSummary($user, $filters),
            'daily_expenses'       => $this->getDailyExpenses($user, $filters),
            'debts_owed'           => $this->getDebtsOwed($user, $filters),
            'debts_receivable'     => $this->getDebtsReceivable($user, $filters),
            'settled_transactions' => $this->getSettledTransactions($user, $filters),
            'category_breakdown'   => $this->getCategoryBreakdown($user, $filters),
            'net_balances' => $this->getNetBalances($user, $filters),
        ];
        // dd($data);s
        return $data;
    } //end generate()


    private function getPeriodDescription(array $filters): string
    {
        if ($filters['period'] === 'custom') {
            $start = Carbon::parse($filters['start_date'])->format('M d, Y');
            $end   = Carbon::parse($filters['end_date'])->format('M d, Y');
            return "$start to $end";
        }

        return 'Last ' . ucfirst($filters['period']);
    } //end getPeriodDescription()


    private function getSummary(User $user, array $filters): array
    {
        return [
            'total_spent'      => $this->getTotalSpent($user, $filters),
            'total_owed'       => $this->getTotalOwed($user, $filters),
            'total_receivable' => $this->getTotalReceivable($user, $filters),
            'net_balance'      => $this->getNetBalance($user, $filters),
        ];
    } //end getSummary()


    /**
     * The getDailyExpenses
     *
     * @param  User  $user
     * @param  array $filters
     * @return Collection
     */
    private function getDailyExpenses(User $user, array $filters): Collection
    {
        $query = Expense::where('user_id', $user->id)->with('expenseCategory')->filterByDate($filters);

        return $query->get()->groupBy(function ($expense) {
            return $expense->paid_at->format('Y-m-d');
        })->map(function ($expenses, $date) {
            return [
                'date'         => $date,
                'total_amount' => $expenses->sum('total_amount'),
                'expenses'     => $expenses,
            ];
        })->sortByDesc('date');
    } //end getDailyExpenses()


    private function getDebtsOwed(User $user, array $filters): Collection
    {
        return Debt::where('borrower_id', $user->id)->with(['lender', 'expense'])->filterByDate($filters)->filterByStatus($filters['status'])->get()->groupBy(groupBy: function ($debt) {
            return $debt->lender->name;
        });
    } //end getDebtsOwed()


    private function getDebtsReceivable(User $user, array $filters): Collection
    {
        return Debt::where('lender_id', $user->id)->with(['borrower', 'expense'])->filterByDate($filters)->filterByStatus($filters['status'])->get()->groupBy(function ($debt) {
            return $debt->borrower->name;
        });
    } //end getDebtsReceivable()


    private function getSettledTransactions(User $user, array $filters): Collection
    {
        return Debt::where(function ($query) use ($user) {
            $query->where('borrower_id', $user->id)->orWhere('lender_id', $user->id);
        })->settled()->with(['lender', 'borrower', 'expense'])->filterByDate($filters)->latest()->get()->groupBy(function ($debt) {
            return $debt->expense_date->format('Y-m-d');
        });
    } //end getSettledTransactions()

    // In App\Services\ReportService.php

    public function getNetBalances(User $user, array $filters): Collection
    {
        $owed = $this->getDebtsOwed($user, $filters);
        $receivable = $this->getDebtsReceivable($user, $filters);

        // Combine all people you have transactions with
        $people = collect([])
            ->merge($owed->keys())
            ->merge($receivable->keys())
            ->unique()
            ->sort();

        return $people->mapWithKeys(function ($person) use ($owed, $receivable) {
            $totalOwed = $owed->has($person) ? $owed[$person]->sum('amount') : 0;
            $totalReceivable = $receivable->has($person) ? $receivable[$person]->sum('amount') : 0;
            $netBalance = $totalReceivable - $totalOwed;

            return [
                $person => [
                    'you_owe' => $totalOwed,
                    'owes_you' => $totalReceivable,
                    'net_balance' => $netBalance,
                    'is_positive' => $netBalance >= 0
                ]
            ];
        })->sortByDesc('net_balance');
    }

    // Then add this to the generate() method:

    private function getCategoryBreakdown(User $user, array $filters): Collection
    {
        $expenses = Expense::where('user_id', $user->id)->with('expenseCategory')->filterByDate($filters)->get();

        $total = $expenses->sum('total_amount');

        return $expenses->groupBy(function ($expense) {
            return $expense->expenseCategory->name ?? 'Uncategorized';
        })->map(function ($expenses, $category) use ($total) {
            $sum = $expenses->sum('total_amount');
            return [
                'total'      => $sum,
                'count'      => $expenses->count(),
                'percentage' => $total > 0 ? round(($sum / $total) * 100) : 0,
            ];
        })->sortByDesc('total');
    } //end getCategoryBreakdown()


    private function getTotalSpent(User $user, array $filters): float
    {
        return Expense::whereHas('payers', function($query) use ($user) {
            $query->where('users.id', $user->id);
        })
        ->with(['payers' => function($query) use ($user) {
            $query->where('users.id', $user->id);
        }])
        ->filterByDate($filters)
        ->get()
        ->sum(function($expense) {
            return $expense->payers->first()->pivot->amount_paid;
        });
    } //end getTotalSpent()


    private function getTotalOwed(User $user, array $filters): float
    {
        return Debt::where('borrower_id', $user->id)->unsettled()->filterByDate($filters)->sum('amount');
    } //end getTotalOwed()


    private function getTotalReceivable(User $user, array $filters): float
    {
        return Debt::where('lender_id', $user->id)->unsettled()->filterByDate($filters)->sum('amount');
    } //end getTotalReceivable()


    private function getNetBalance(User $user, array $filters): float
    {
        return $this->getTotalReceivable($user, $filters) - $this->getTotalOwed($user, $filters);
    } //end getNetBalance()


}//end class
