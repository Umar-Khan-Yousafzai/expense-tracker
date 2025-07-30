<?php

namespace App\Jobs;

use App\Mail\ExpenseReportMonthlyMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\User;
use App\Services\ReportService;
use Illuminate\Support\Facades\Mail;


class SendExpenseReportMonthlyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $filters;

    public function __construct(User $user, array $filters = [])
    {
        $this->user = $user;
        $this->filters = $filters;
    }

    public function handle(ReportService $reportService)
    {
        logger()->info('Starting SendExpenseReportMonthlyJob for user: ' . $this->user->email);

        $report = $reportService->generate($this->user, $this->filters);

        $debts_owed = $report['debts_owed']->mapWithKeys(function ($debts, $person) {
            return [
                $person => $debts->filter(function ($debt) {
                    return $debt instanceof \App\Models\Debt
                        && !is_null($debt->id)
                        && !is_null($debt->expense_id)
                        && !is_null($debt->expense_date)
                        && !is_null($debt->amount)
                        && isset($debt->is_settled);
                })->map(function ($debt) {
                    return [
                        'id' => $debt->id,
                        'expense_id' => $debt->expense_id,
                        'expense_date' => $debt->expense_date->toDateString(),
                        'amount' => $debt->amount,
                        'is_settled' => $debt->is_settled,
                        'lender_name' => $debt->lender ? $debt->lender->name : 'Unknown',
                        'expense_description' => $debt->expense ? $debt->expense->description : 'No description',
                    ];
                })->toArray()
            ];
        })->filter()->toArray();
        logger()->info(json_decode($report['user_expense_summary'],true));
        try {
            logger()->info('Email sent successfully to: ' . $this->user->email);
        } catch (\Exception $e) {
            logger()->error('Failed to send email to: ' . $this->user->email, ['error' => $e->getMessage()]);
            throw $e; // Ensure failure is logged to failed_jobs table
        }
    }
}
