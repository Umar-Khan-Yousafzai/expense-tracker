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
        // Handle null or empty filters
        if (empty($filters)) {
            return $query;
        }

        // Custom date range
        if ($filters['period'] === 'custom') {
            $startDate = $filters['start_date']
                ? Carbon::parse($filters['start_date'])->startOfDay()
                : now()->subMonth();

            $endDate = $filters['end_date']
                ? Carbon::parse($filters['end_date'])->endOfDay()
                : now();

            return $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Predefined periods
        return match ($filters['period']) {
            'week' => $query->where('created_at', '>=', now()->subWeek()),
            'month' => $query->where('created_at', '>=', now()->subMonth()),
            'year' => $query->where('created_at', '>=', now()->subYear()),
            default => $query // Fallback if period is invalid
        };
    }

    public function scopeFilterByStatus($query, string $status)
    {
        if ($status === 'all') return $query;

        return $status === 'settled'
            ? $query->settled()
            : $query->unsettled();
    }
}//end class
