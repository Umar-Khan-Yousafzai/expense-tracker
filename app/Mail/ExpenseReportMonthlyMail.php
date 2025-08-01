<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Services\ReportService;

class ExpenseReportMonthlyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $summary;
    public $debts_owed;

    public $balanceDetails;
    public function __construct(User $user, array $summary, array $debts_owed, $balanceDetails)
    {
        $this->user = $user;
        $this->summary = $summary;
        $this->debts_owed = $debts_owed;
        $this->balanceDetails = $balanceDetails;
        logger($balanceDetails);
    }

    public function build()
    {

        return $this->subject('Your Expense Report Summary')
                    ->view('emails.monthly-expense-notification')
                    ->with([
                        'user' => $this->user,
                        'summary' => $this->summary,
                        'debts_owed' => $this->debts_owed,
                        'balanceDetails' => $this->balanceDetails,
                    ]);
    }
}
