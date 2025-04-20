<?php
namespace App\Services;

use App\Models\Debt;
use App\Models\Settlement;

class DebtService
{
    /**
     * Settle a debt (full or partial payment)
     */
    public function settleDebt(int $payerId, int $receiverId, float $amount): void
    {
        \DB::transaction(function () use ($payerId, $receiverId, $amount) {
            // 1. Get all unpaid debts between these users
            $debts = Debt::where('lender_id', $receiverId)->where('borrower_id', $payerId)->where('is_settled', false)->orderBy('created_at')->get();

            // 2. Apply payment to oldest debts first
            $remaining = $amount;
            foreach ($debts as $debt) {
                if ($remaining <= 0) {
                    break;
                }

                $settledAmount = min($debt->amount, $remaining);
                $debt->decrement('amount', $settledAmount);
                $remaining -= $settledAmount;

                if ($debt->amount == 0) {
                    $debt->update(['is_settled' => true]);
                }
            }

            // 3. Record the settlement
            if ($amount > 0) {
                Settlement::create([
                    'payer_id'    => $payerId,
                    'receiver_id' => $receiverId,
                    'amount'      => $amount,
                    'settled_at'  => now(),
                ]);
            }
        });
    }//end settleDebt()


    /**
     * Get net balance for a user
     */
    public function getNetBalance(int $userId): float
    {
        return $this->getTotalOwedToUser($userId) - $this->getTotalUserOwes($userId);
    }//end getNetBalance()


    // Helper methods
    public function getTotalOwedToUser(int $userId): float
    {
        return Debt::where('lender_id', $userId)->where('is_settled', false)->sum('amount');
    }//end getTotalOwedToUser()


    public function getTotalUserOwes(int $userId): float
    {
        return Debt::where('borrower_id', $userId)->where('is_settled', false)->sum('amount');
    }//end getTotalUserOwes()


}//end class
