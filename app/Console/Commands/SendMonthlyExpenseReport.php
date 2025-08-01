<?php

namespace App\Console\Commands;

use App\Jobs\SendExpenseReportMonthlyJob;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;

class SendMonthlyExpenseReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-monthly-expense-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $users = User::all();
            foreach ($users as $user) {
                SendExpenseReportMonthlyJob::dispatch($user);
            }
            logger('Monthly expense reports dispatched successfully.');
            $this->info('Monthly reports dispatched successfully.');
        } catch (Exception $e) {
            logger('Error dispatching monthly expense reports: ' . $e->getMessage());
        }
    }
}
