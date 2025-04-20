<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Expense;

class DebtModal extends Component
{

    public $expense = null;

    /**
     * The listeners
     *
     * @var array
     */
    protected $listeners = ['open-debt-modal' => 'loadExpense'];


    /**
     * loadExpense
     *
     * @param  mixed $expenseId
     * @return void
     */
    public function mount($expenseId)
    {
        $this->expense = Expense::with(['unsettledDebts.borrower', 'unsettledDebts.lender'])->find($expenseId);
    }//end loadExpense()


    public function render()
    {
        return view('livewire.debt-modal');
    }//end render()


}//end class
