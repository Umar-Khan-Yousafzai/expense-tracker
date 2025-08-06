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
    protected $signature = 'email:send-monthly-report';
    protected $description = 'Send the monthly expense report to all users';
    public function __construct(User $user, array $filters = [])
    {
        $this->user = $user;
        $this->filters = $filters;
    }

    public function handle(ReportService $reportService)
    {
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
        $netBalances = [];
        logger($report['net_balances']);
        foreach ($report['net_balances']->toArray() ?? [] as $person => $balance) {
            if (!isset($netBalances[$person])) {
                $netBalances[$person] = [
                    'you_owe' => 0,
                    'owes_you' => 0,
                    'net_balance' => 0,
                ];
            }

            $netBalances[$person]['you_owe'] += $balance['you_owe'] ?? 0;
            $netBalances[$person]['owes_you'] += $balance['owes_you'] ?? 0;
            $netBalances[$person]['net_balance'] = $netBalances[$person]['owes_you'] - $netBalances[$person]['you_owe'];
        }
        Mail::to($this->user->email)->send(new ExpenseReportMonthlyMail(
            $this->user,
            $report['summary'],
            $debts_owed,
            $netBalances
        ));
        try {
            logger()->info('Email sent successfully to: ' . $this->user->email);
        } catch (\Exception $e) {
            logger()->error('Failed to send email to: ' . $this->user->email, ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
