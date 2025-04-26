<?php

namespace App\Livewire;

use App\Services\ExpenseService;
use App\Services\UserService;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

/**
 * AddExpense
 */
class AddExpense extends Component
{
    use Toast;

    /**
     * The expense service instance.
     *
     * @var \App\Services\ExpenseService
     */
    protected $expenseService;

    /**
     * The expense service instance.
     *
     * @var \App\Services\UserService
     */
    protected $userService;

    /**
     * The expense amount.
     *
     * @var float
     */
    public float $amount;

    /**
     * The expense description.
     *
     * @var string
     */
    public $description;

    /**
     * Expense categories.
     *
     * @var array
     */
    public $categories = [];

    /**
     * Selected category.
     *
     * @var mixed
     */
    public $selectedCategory;

    /**
     * The date and time when the expense was paid.
     *
     * @var mixed
     */
    public $dateTimePaidAt;

    /**
     * The array of users who paid the expense.
     *
     * @var array
     */
    public $expenseSharedWith = [];

    /**
     * The array of users fetched from the database.
     *
     * @var array
     */
    public $fetchedUsers = [];

    /**
     * Expense Description.
     *
     * @var mixed
     */
    #[Validate('max:100')]
    public $expenseDescription;

    /**
     * The array of payers.
     *
     * @var array
     */
    public $payers = [
        [
            'user_id'            => null,
            'amount'             => 0,
            'exclude_from_share' => false,
            'role'               => 'payer',
        ],
    ];


    /**
     * Add the payer
     *
     * @return void
     */
    public function addPayer()
    {
        $this->payers[] = [
            'user_id'            => null,
            'amount'             => 0,
            'exclude_from_share' => false,
            'role'               => 'payer',
        ];
    }//end addPayer()


    /**
     * Removes the payer from the array.
     *
     * @param  mixed $index
     * @return void
     */
    public function removePayer(mixed $index)
    {
        unset($this->payers[$index]);
        $this->payers = array_values($this->payers);
        // Reindex array
    }//end removePayer()


    /**
     * The validation rules for the component.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'selectedCategory'            => [
                'required',
                'integer',
                'exists:expense_categories,id',
            ],
            'amount'                      => [
                'required',
                'numeric',
                'min:1',
            ],
            'dateTimePaidAt'              => [
                'required',
                'date',
            ],
            'expenseSharedWith'           => [
                'required',
                'array',
                'min:1',
            ],
            'expenseSharedWith.*'         => [
                'integer',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $payerIds = array_column($this->payers ?? [], 'user_id');
                    if (in_array($value, $payerIds)) {
                        $fail('A person who is paying both payers and shared list.');
                    }
                },
            ],
            'payers'                      => [
                'required',
                'array',
                'min:1',
            ],
            'payers.*.user_id'            => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    if (in_array($value, $this->expenseSharedWith ?? [])) {
                        $fail('A person in Payer list cannot be in shared list.');
                    }
                },
            ],
            'payers.*.amount'             => 'required|numeric|min:0.01',
            'payers.*.exclude_from_share' => 'boolean',
        ];
    }//end rules()


    /**
     * The boot function
     *
     * @param \App\Services\ExpenseService $expenseService Expense service instance.
     * @param \App\Services\UserService    $userService    Expense service instance.
     *
     * @return void
     */
    public function boot(ExpenseService $expenseService, UserService $userService)
    {
        $this->expenseService = $expenseService;
        $this->userService    = $userService;
    }//end boot()


    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->amount       = 0.0;
        $this->description  = '';
        $this->categories   = $this->expenseService->getAllCategories();
        $this->fetchedUsers = $this->userService->getAllUsers();

    }//end mount()


    /**
     * Add a new expense.
     *
     * @return void
     */
    public function addExpense()
    {
        $this->reset(['amount', 'description']);
    }//end addExpense()


    /**
     * The render function for component.
     *
     * @return mixed
     */
    public function render()
    {
        return view('livewire.add-expense');
    }//end render()


    /**
     * Save the expense.
     *
     * @return void
     */
    public function save()
    {
        $this->validate();
        $totalPaid = collect($this->payers)->sum('amount');
        if (abs($totalPaid - $this->amount) > 0.01) {
            $this->addError('amount', 'Sum of individual payments must match the total amount.');
            return;
        }

        foreach ($this->expenseSharedWith as $key => $value) {
            $this->expenseSharedWith[$key] = [
                'user_id'            => $value,
                'role'               => 'participant',
                'amount'             => 0,
                'exclude_from_share' => false,
            ];
        }

        $totalPeople = array_merge($this->payers, $this->expenseSharedWith);
        logger($totalPeople);
        /**
         * @disregard
         */
        $data = [
            'user_id'             => auth()->id(),
            'expense_category_id' => $this->selectedCategory,
            'total_amount'        => $this->amount,
            'description'         => $this->description,
            'paid_at'             => $this->dateTimePaidAt,
            'total_people'        => $totalPeople,

        ];
         $this->expenseService->createExpense(data:$data);
         $this->reset(['amount', 'description', 'selectedCategory', 'dateTimePaidAt', 'expenseSharedWith' ]);
        $this->success(
            'Expense added successfully!',
            'Please check your shares now',
            redirectTo: route(name: 'view.expenses'),
        );

    }//end save()


}//end class
