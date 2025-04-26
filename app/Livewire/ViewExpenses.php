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
     * The headers for the table.
     *
     * @var array
     */
    public $headers = [
        [
            'key'   => 'id',
            'label' => '#',
            'class' => 'w-1',
        ],
        [
            'key'   => 'paid_at',
            'label' => 'date',
            'class' => 'w-1',
        ],
        [
            'key'   => 'description',
            'label' => 'Description',
        ],
        [
            'key'   => 'total_amount',
            'label' => 'Amount (RS)',
        ],
        [
            'key'   => 'payers',
            'label' => 'Paid By',
            'class' => 'w-48',
        ],
        [
            'key'   => 'participants',
            'label' => 'Shared With',
            'class' => 'w-48',
        ],
        [
            'key'   => 'debts',
            'label' => 'Debts',
            'class' => 'w-32',
        ],
        [
            'key'   => 'actions',
            'label' => 'Actions',
        ],
    ];


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
        return view('livewire.view-expenses', [
            'headers'  => $this->headers,
            'expenses' => $this->expenseService->getAllExpensesWithParticipants(),
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
