<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ExpenseParticipant
 */
class ExpenseParticipant extends Model
{

    /**
     * The table associated with the model.
     *
     * @var array
     */
    protected $fillable = [
        'expense_id',
        'user_id',
        'role',
        'amount',
        'amount_paid',
    ];


    /**
     * The expense that this participant belongs to.
     *
     * @return mixed
     */


    /**
     * The expense that this participant belongs to.
     *
     * @return mixed
     */
    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }//end expense()


    /**
     * The user that this participant belongs to.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }//end user()


}//end class
