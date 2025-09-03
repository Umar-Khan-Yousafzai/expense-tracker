<?php

namespace App\Livewire;

use App\Models\Expense;
use App\Services\ExpenseService;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

/**
 * ViewExpenses
 */
class ViewExpenses extends Component
{
    use WithPagination, Toast;

    /**
     * Search term for filtering expenses
     *
     * @var string
     */
    public $search = '';

    /**
     * Status filter for expenses
     *
     * @var string
     */
    public $statusFilter = '';

    /**
     * Selected expenses for bulk operations
     *
     * @var array
     */
    public $selectedExpenses = [];

    /**
     * Select all checkbox state
     *
     * @var bool
     */
    public $selectAll = false;

    /**
     * The showModal flag.
     *
     * @var boolean
     */
    public $showModal = false;

    /**
     * The expense service instance.
     *
     * @var \App\Services\ExpenseService
     */
    protected $expenseService;

    /**
     * The selected expense
     *
     * @var mixed
     */
    public $selectedExpense = null;

    /**
     * The showDeleteModal flag.
     *
     * @var boolean
     */
    public $showDeleteModal = false;

    /**
     * The selected expense Id .
     *
     * @var integer
     */
    public int $expenseId;


    /**
    /**
     * The boot function
     *
     * @param \App\Services\ExpenseService $expenseService Expense service instance.
     *
     * @return void
     */
    public function boot(ExpenseService $expenseService)
    {
        $this->expenseService = $expenseService;
    }//end boot()

    /**
     * Reset pagination when search changes
     */
    public function updatedSearch()
    {
        $this->resetPage();
    }

    /**
     * Reset pagination when status filter changes
     */
    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    /**
     * Handle select all checkbox
     */
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedExpenses = $this->getFilteredExpenses()->pluck('id')->toArray();
        } else {
            $this->selectedExpenses = [];
        }
    }

    /**
     * Get filtered expenses for current page
     */
    private function getFilteredExpenses()
    {
        $userId = auth()->id();
        
        $query = Expense::with([
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
            });

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('description', 'like', '%' . $this->search . '%')
                  ->orWhereHas('expenseCategory', function ($categoryQuery) {
                      $categoryQuery->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        // Apply status filter
        if ($this->statusFilter === 'settled') {
            $query->whereDoesntHave('unsettledDebts');
        } elseif ($this->statusFilter === 'unsettled') {
            $query->whereHas('unsettledDebts');
        }

        return $query->latest();
    }

    /**
     * Bulk settle selected expenses
     */
    public function bulkSettle()
    {
        if (empty($this->selectedExpenses)) {
            $this->error('No expenses selected for settlement.');
            return;
        }

        // For now, just show a success message
        // In the future, this would integrate with the settlement service
        $count = count($this->selectedExpenses);
        $this->success("Bulk settlement initiated for {$count} expense(s). This feature will be implemented soon!");
        
        // Clear selections
        $this->selectedExpenses = [];
        $this->selectAll = false;
    }


      /**
       * Mount the component.
       *
       * @return void
       */
    public function mount()
    {
    }//end mount()


    /**
     * Render the view for the component.
     *
     * @return mixed
     */
    public function render()
    {
        $expenses = $this->getFilteredExpenses()->paginate(10);
        
        return view('livewire.view-expenses', [
            'expenses' => $expenses,
        ]);
    }//end render()


    // Add this method


    /**
     * Shows the debts of the selected expense.
     *
     * @param  mixed $expenseId
     * @return void
     */
    public function showDebts(mixed $expenseId)
    {
        $this->selectedExpense = Expense::with(['unsettledDebts.borrower', 'unsettledDebts.lender'])->find($expenseId);
        $this->showModal       = true;
    }//end showDebts()


    /**
     * Delete the selected expense.
     *
     * @param  integer $expenseId
     * @return void
     */
    public function delete(int $expenseId)
    {
        $expense               = $this->expenseService->deleteExpense($expenseId);
        $this->showDeleteModal = false;
        if ($expense) {
            $this->success(title: 'Success!', description:'Expense deleted successfully');
        } else {
            $this->error('Error!', 'Failed to delete expense.');
        }
    }//end delete()


    /**
     * Show the delete confirmation modal.
     *
     * @param  integer $expenseId
     * @return void
     */
    public function confirmDelete(int $expenseId)
    {
        $this->expenseId       = $expenseId;
        $this->showDeleteModal = true;

    }//end confirmDelete()


    /**
     * This is edit expense function
     *
     * @param  integer $expenseId
     * @return void
     */
    public function editExpense(int $expenseId)
    {
        redirect(route('edit.expense', $expenseId));
    }//end editExpense()


        /**
         * This is edit expense function
         *
         * @param  integer $expenseId
         * @return void
         */
    public function viewExpense(int $expenseId)
    {
        redirect(route('view.expense', $expenseId));
    }//end viewExpense()


}//end class
