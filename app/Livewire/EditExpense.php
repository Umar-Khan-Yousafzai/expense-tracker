<?php

namespace App\Livewire;

use App\Models\Expense;
use App\Services\ExpenseService;
use App\Services\UserService;
use Carbon\Carbon;
use Livewire\Component;
use Mary\Traits\Toast;

class EditExpense extends Component
{
    use Toast;

    protected ExpenseService $expenseService;

    protected UserService $userService;

    public Expense $expense;

    public float $amount;

    public string $description = '';

    public $categories = [];

    public $selectedCategory;

    public $dateTimePaidAt;

    public $fetchedUsers = [];

    public $payers = [];

    public $expenseSharedWith = [];


    public function boot(ExpenseService $expenseService, UserService $userService)
    {
        $this->expenseService = $expenseService;
        $this->userService    = $userService;
    } //end boot()


    public function mount(Expense $expense)
    {
        $this->expense          = $expense;
        $this->amount           = $expense->total_amount;
        $this->description      = $expense->description ?? '';
        $this->selectedCategory = $expense->expense_category_id;
        $this->dateTimePaidAt   = Carbon::parse($expense->paid_at)->format('Y-m-d');
        $this->categories       = $this->expenseService->getAllCategories();
        $this->fetchedUsers     = $this->userService->getAllUsers();

        // Load existing payers
        $this->payers = $expense->payers->map(function ($payer) {

            return [
                'user_id'            => $payer->id,
                'amount'             => $payer->pivot->amount_paid,
                'exclude_from_share' => $payer->pivot->exclude_from_share === 1 ? true : false,
                'role'               => $payer->pivot->role,
            ];
        })->toArray();
        $this->expenseSharedWith = $expense->sharedWith->map(function ($participant) {

            return [
                'user_id'            => $participant->id,
                'amount'             => $participant->pivot->amount_paid,
                'exclude_from_share' => $participant->pivot->exclude_from_share === 1 ? true : false,
                'role'               => $participant->pivot->role,
            ];
        })->toArray();
        $this->payers = array_merge($this->expenseSharedWith, $this->payers);

        // Load existing participants
        // $this->expenseSharedWith = $expense->sharingParticipants->whereNotIn('id', $payerIds)->pluck('id')->toArray();

        // dd([$expense->payers,$expense->sharingParticipants]);

    } //end mount()


    public function addPayer()
    {
        $this->payers[] = [
            'user_id'            => null,
            'amount'             => 0,
            'exclude_from_share' => false,
            'role'               => 'payer',
        ];
    } //end addPayer()


    public function removePayer($index)
    {
        unset($this->payers[$index]);
        $this->payers = array_values($this->payers);
    } //end removePayer()


    public function save()
    {
        $this->validate([
            'selectedCategory'  => 'required|exists:expense_categories,id',
            'amount'            => 'required|numeric|min:1',
            'dateTimePaidAt'    => 'required|date',
            'expenseSharedWith' => 'required|array|min:1',
            'payers'            => 'required|array|min:1',
            'payers.*.user_id'  => 'required|exists:users,id',
            'payers.*.amount'   => 'required|numeric|min:0.00',
        ]);

        $totalPaid = collect($this->payers)->sum('amount');
        if (abs($totalPaid - $this->amount) > 0.01) {
            $this->addError('amount', 'Sum of individual payments must match the total amount.');
            return;
        }
        // Prepare participants data
        foreach ($this->payers as $key => $value) {
            if ($value['amount'] <= 0.01 || $value['amount'] <= '0.01') {
                $this->payers[$key]['role'] = 'participant';
            } else {
                $this->payers[$key]['role'] = 'payer';
            }
        }
        $totalPeople = $this->payers;

        $data = [
            'user_id'             => auth()->id(),
            'expense_category_id' => $this->selectedCategory,
            'total_amount'        => $this->amount,
            'description'         => $this->description,
            'paid_at'             => $this->dateTimePaidAt,
            'total_people'        => $totalPeople,
        ];

        $this->expenseService->updateExpense($this->expense, $data);
        $this->success('Expense updated successfully!', redirectTo: route('view.expenses'));
    } //end save()


    public function render()
    {
        return view('livewire.edit-expense');
    } //end render()


}//end class
