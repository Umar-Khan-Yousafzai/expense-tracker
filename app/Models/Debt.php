<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = [
        'expense_id', 'lender_id', 'borrower_id', 'amount', 'is_settled'
    ];

    // Relationships
    public function lender()
    {
        return $this->belongsTo(User::class, 'lender_id');
    }

    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }
}
