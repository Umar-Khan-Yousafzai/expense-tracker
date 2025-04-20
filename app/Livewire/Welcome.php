<?php

namespace App\Livewire;

use App\Models\Debt;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Support\Collection;
use Livewire\Component;
use Mary\Traits\Toast;

class Welcome extends Component
{
    use Toast;

    public string $search = '';

    public $owedToUser = 0;

    public $userOwes = 0;

    public $netBalance = 0;

    public bool $drawer = false;

    public $totalExpenses = 0;

    public $currentMonthExpenses = 0;

    public $unsettledDebtsCount = 0;

    public $averageExpense = 0;

    public array $sortBy = [
        'column'    => 'name',
        'direction' => 'asc',
    ];

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }//end clear()


    // Delete action
    public function delete($id): void
    {
        $this->warning("Will delete #$id", 'It is fake.', position: 'toast-bottom');
    }//end delete()


    // Table headers
    public function headers(): array
    {
        return [
            [
                'key'   => 'id',
                'label' => '#',
                'class' => 'w-1',
            ],
            [
                'key'   => 'name',
                'label' => 'Name',
                'class' => 'w-64',
            ],
            [
                'key'   => 'age',
                'label' => 'Age',
                'class' => 'w-20',
            ],
            [
                'key'      => 'email',
                'label'    => 'E-mail',
                'sortable' => false,
            ],
        ];
    }//end headers()


    // In your Livewire component
    public function mount()
    {
        $this->totalExpenses        = Expense::sum('total_amount');
        $this->currentMonthExpenses = Expense::whereMonth('paid_at', now()->month)->sum('total_amount');
        $this->unsettledDebtsCount  = Debt::where('is_settled', false)->count();
        $this->averageExpense       = Expense::avg('total_amount');

        // User-specific
        $this->owedToUser = Debt::where('lender_id', auth()->id())->where('is_settled', false)->sum('amount');

        $this->userOwes = Debt::where('borrower_id', auth()->id())->where('is_settled', false)->sum('amount');

        $this->netBalance = $this->owedToUser - $this->userOwes;

        // Activity stats
        $this->recentExpensesCount = Expense::where('created_at', '>=', now()->subDays(7))->count();
        $this->topCategory         = ExpenseCategory::withSum('expenses', 'total_amount')->orderByDesc('expenses_sum_total_amount')->first()?->name ?? 'N/A';

        $this->largestExpense = Expense::whereMonth('paid_at', now()->month)->max('total_amount');
    }//end mount()


    public function render()
    {
        return view('livewire.welcome');
    }//end render()


}//end class
