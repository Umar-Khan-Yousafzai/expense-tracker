<?php
namespace App\Livewire;

use App\Models\Expense;
use Livewire\Component;

/**
 * ViewExpense
 */
class ViewExpense extends Component
{

    public Expense $expense;


    public function mount(Expense $expense)
    {
        $this->expense = $expense->load([
            'expenseCategory',
            'payers',
            'sharingParticipants',
            'unsettledDebts.borrower',
            'unsettledDebts.lender',
        ]);


    }//end mount()


    public function render()
    {
        return view('livewire.view-expense');
    }//end render()


}//end class
