<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Expense
 *
 * @property      int $id
 * @property      int $user_id
 * @property      int|null $expense_category_id
 * @property      array<array-key, mixed>|null $expense_data
 * @property      \Illuminate\Support\Carbon|null $deleted_at
 * @property      \Illuminate\Support\Carbon|null $created_at
 * @property      \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ExpenseCategory|null $expenseCategory
 * @property-read \App\Models\User $user
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|Expense newModelQuery()
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|Expense newQuery()
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|Expense onlyTrashed()
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|Expense query()
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|Expense whereCreatedAt($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|Expense whereDeletedAt($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|Expense whereExpenseCategoryId($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|Expense whereExpenseData($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|Expense whereId($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|Expense whereUpdatedAt($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|Expense whereUserId($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|Expense withTrashed()
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|Expense withoutTrashed()
 * @mixin         \Eloquent
 */
class Expense extends Model
{
    use SoftDeletes;

    /**
     * Protected fillable for the model
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'expense_category_id',
        'total_amount',
        'description',
        'paid_at',

    ];

    /**
     * The dates
     *
     * @var array
     */
    protected $dates = [
        'paid_at',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];
    /**
     * Creates the relationship with user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }//end user()


    /**
     * Relationship with expense category.
     *
     * @return mixed
     */
    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }//end expenseCategory()


     /**
      * Relationship with expense category.
      *
      * @return mixed
      */
    public function participants()
    {
        return $this->belongsToMany(User::class, 'expense_participants')->withPivot('role', 'amount', 'amount_paid', 'exclude_from_share')->withTimestamps();
    }//end participants()


    /**
     * Relationship with expense category.
     *
     * @return mixed
     */
    public function payers()
    {
        return $this->participants()->wherePivot('role', 'payer', 'amount_paid');
    }//end payers()


    /**
     * Relationship with expense category.
     *
     * @return mixed
     */
    public function sharedWith()
    {
        return $this->participants()->wherePivot('role', 'payer', 'amount_paid');
    }//end sharedWith()


    public function expenseParticipants()
    {
        return $this->hasMany(ExpenseParticipant::class);
    }//end expenseParticipants()


    /**
     * Get all debts associated with this expense.
     */
    public function debts()
    {
        return $this->hasMany(Debt::class);
    }//end debts()


    /**
     * Get only unsettled debts.
     */
    public function unsettledDebts()
    {
        return $this->hasMany(Debt::class)->where('is_settled', false);
    }//end unsettledDebts()


    /**
     * Sharing Participants.
     *
     * @return mixed
     */
    public function sharingParticipants()
    {
        return $this->belongsToMany(User::class, 'expense_participants')->wherePivot('exclude_from_share', false)->withPivot(['amount', 'amount_paid']);
    }//end sharingParticipants()


    // In Expense.php (model)
    public function scopeGroupedByDate($query)
    {
        return $query->selectRaw('
        DATE(paid_at) as date,
        SUM(total_amount) as total_amount,
        GROUP_CONCAT(id) as expense_ids
    ')->groupBy('date');
    }//end scopeGroupedByDate()


    // Usage in ReportService


    /**
     * getSpending
     *
     * @param  mixed $user
     * @param  mixed $filters
     * @return void
     */
    private function getSpending(User $user, array $filters)
    {
        return self::byUser($user->id)->filter($filters)->groupedByDate()->orderBy('date', 'desc')->get()->map(function ($group) {
            return [
                'date'         => $group->date,
                'total_amount' => $group->total_amount,
                'expenses'     => Expense::findMany(explode(',', $group->expense_ids)),
            ];
        });
    }//end getSpending()


    /**
     * The scopeFilterByDate
     *
     * @param  mixed $query
     * @param  array $filters
     * @return mixed
     */
    public function scopeFilterByDate($query, array $filters)
    {
        // Handle null or empty filters
        if (empty($filters)) {
            return $query;
        }

        // Custom date range
        if ($filters['period'] === 'custom') {
            $startDate = Carbon::parse($filters['start_date'] ?? now()->subMonth())->startOfDay();
            $endDate   = Carbon::parse($filters['end_date'] ?? now())->endOfDay();

            return $query->whereBetween('paid_at', [$startDate, $endDate]);
        }

        // Predefined periods
        return match ($filters['period']) {
            'week' => $query->where('paid_at', '>=', now()->subWeek()),
            'month' => $query->where('paid_at', '>=', now()->subMonth()),
            'year' => $query->where('paid_at', '>=', now()->subYear()),
            default => $query
            // Fallback if period is invalid
        };
    }//end scopeFilterByDate()


}//end class
