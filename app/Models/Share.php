<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Share
 *
 * @property int $id
 * @property int $expense_id
 * @property string|null $share_data
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Expense $expense
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Share newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Share newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Share onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Share query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Share whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Share whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Share whereExpenseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Share whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Share whereShareData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Share whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Share withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Share withoutTrashed()
 * @mixin \Eloquent
 */
class Share extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'expense_id',
        'share_data',
    ];


    /**
     * Get the expense associated with the share.
     *
     * @return mixed
     */
    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }//end expense()


    /**
     * Get the shares for a specific user through the expenses table.
     *
     * @param  integer $userId The ID of the user.
     * @return mixed
     */
    public static function getSharesByUserId(int $userId)
    {
        return self::whereHas('expense', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
    }//end getSharesByUserId()


}//end class
