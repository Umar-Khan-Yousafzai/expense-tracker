<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

/**
 * User
 *
 * @property      int $id
 * @property      string $name
 * @property      string $email
 * @property      \Illuminate\Support\Carbon|null $email_verified_at
 * @property      string $password
 * @property      string|null $remember_token
 * @property      \Illuminate\Support\Carbon|null $created_at
 * @property      \Illuminate\Support\Carbon|null $updated_at
 * @property      \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExpenseCategory> $expenseCategories
 * @property-read int|null $expense_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Expense> $expenses
 * @property-read int|null $expenses_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Share> $shares
 * @property-read int|null $shares_count
 * @method        static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed()
 * @method        static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 * @mixin         \Eloquent
 */
class User extends Authenticatable
{
    /**
 * @use HasFactory<\Database\Factories\UserFactory>
*/
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }//end casts()


    /**
     * Get the user's initials
     *
     * @return mixed
     */
    public function initials(): string
    {
        return Str::of($this->name)->explode(' ')->map(fn(string $name) => Str::of($name)->substr(0, 1))->implode('');
    }//end initials()


    /**
     * Get the expense categories associated with the user.
     *
     * @return mixed
     */
    public function expenseCategories()
    {
        return $this->hasMany(ExpenseCategory::class);
    }//end expenseCategories()


    /**
     * Get the expenses associated with the user.
     *
     * @return mixed
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }//end expenses()


    /**
     * Get the shares associated with the user.
     *
     * @return mixed
     */
    public function shares()
    {
        return $this->hasMany(Share::class);
    }//end shares()


    /**
     * Expenses that the user is a participant in (whether paying or sharing)
     *
     * @return mixed
     */
    public function expensesParticipated()
    {
        return $this->belongsToMany(Expense::class, 'expense_participants')->$this->participants()->wherePivot('role', 'payer', 'amount_paid')->withTimestamps();
    }//end expensesParticipated()


    public function debtsOwedToMe()
    {
        return $this->hasMany(Debt::class, 'lender_id')->where('is_settled', false);
    }//end debtsOwedToMe()


    public function debtsIOwe()
    {
        return $this->hasMany(Debt::class, 'borrower_id')->where('is_settled', false);
    }//end debtsIOwe()


    public function settlementsPaid()
    {
        return $this->hasMany(Settlement::class, 'payer_id');
    }//end settlementsPaid()


    public function settlementsReceived()
    {
        return $this->hasMany(Settlement::class, 'receiver_id');
    }//end settlementsReceived()


}//end class
