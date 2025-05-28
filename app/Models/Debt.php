<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Debt extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'expense_id',
        'lender_id',
        'borrower_id',
        'amount',
        'is_settled',
        'expense_date'
    ];

    /**
     * casts
     *
     * @var array
     */
    protected $casts = [
        'expense_date' => 'date',
    ];

    // Relationships
    public function lender()
    {
        return $this->belongsTo(User::class, 'lender_id');
    }//end lender()


    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }//end borrower()


    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }//end expense()


    // Debt.php (model)
    public function scopeToUser($query, $userId)
    {
        return $query->where('borrower_id', $userId);
    }//end scopeToUser()


    public function scopeFromUser($query, $userId)
    {
        return $query->where('lender_id', $userId);
    }//end scopeFromUser()


    public function scopeUnsettled($query)
    {
        return $query->where('is_settled', false);
    }//end scopeUnsettled()


    public function scopeSettled($query)
    {
        return $query->where('is_settled', true);
    }//end scopeSettled()

    public function scopeFilterByDate($query, array $filters)
    {
        if (empty($filters) || empty($filters['period'])) {
            return $query;
        }

        $now = now();
        $startDate = $now->copy()->startOfDay();
        $endDate = $now->copy()->endOfDay();

        switch ($filters['period']) {
            case 'week':
                $startDate = $now->copy()->subWeek()->startOfDay();
                break;

            case 'last_month':
                $lastMonth = $now->copy()->subMonth();
                $startDate = $lastMonth->copy()->startOfMonth()->startOfDay();
                $endDate = $lastMonth->copy()->endOfMonth()->endOfDay();
                break;

            case 'current_month':
                $startDate = $now->copy()->startOfMonth()->startOfDay();
                $endDate = $now->copy()->endOfMonth()->endOfDay();

                break;

            case 'year':
                $startDate = $now->copy()->subYear()->startOfDay();
                $endDate = $now->copy()->endOfDay();
                break;

            case 'custom':
                $startDate = !empty($filters['start_date'])
                    ? Carbon::parse($filters['start_date'])->startOfDay()
                    : $now->copy()->subMonth()->startOfDay();

                $endDate = !empty($filters['end_date'])
                    ? Carbon::parse($filters['end_date'])->endOfDay()
                    : $now->copy()->endOfDay();
                break;

            default:
                // Keep startDate and endDate as today's date
                break;
        }

        return $query->whereBetween('expense_date', [$startDate, $endDate]);
    }


    public function scopeFilterByStatus($query, string $status)
    {
        if ($status === 'all') return $query;

        return $status === 'settled'
            ? $query->settled()
            : $query->unsettled();
    }
}//end class
