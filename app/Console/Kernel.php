<?php

namespace App\Console;

use App\Jobs\SendExpenseReportMonthlyJob;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $users = User::all(); // Or filter active users
            foreach ($users as $user) {
                SendExpenseReportMonthlyJob::dispatch($user);
            }
        })->timezone('Asia/Karachi')->dailyAt('06:00');
        $schedule->call(function () {
            \Log::info('✅ Scheduler is working: ' . now());
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
