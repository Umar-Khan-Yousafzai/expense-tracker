<?php

use App\Jobs\SendExpenseReportMonthlyJob;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;
use Carbon\Carbon;

Schedule::call(function () {
    try {
        Log::info('📤 Starting monthly expense report dispatch...');
        $users = User::all();
        Log::info('Found ' . count($users) . ' users to send reports to.');
        $tz = 'Asia/Karachi';
        $start = Carbon::now($tz)->subMonth()->startOfMonth()->startOfDay()->toDateTimeString();
        $end = Carbon::now($tz)->subMonth()->endOfMonth()->endOfDay()->toDateTimeString();

        Log::info(Carbon::now()->toDateTimeString());
        $filters = [
            'period' => 'last_month',
            'start_date' => $start,
            'end_date' => $end,
            'status' => 'all',
            'debtFilter' => 'all',
        ];
        foreach ($users as $user) {
            SendExpenseReportMonthlyJob::dispatch($user,$filters);
        }
        Log::info(`current start date $start and end date $end`);
        Log::info('Monthly expense reports dispatched to ' . count($users) . ' users.');
    } catch (\Throwable $e) {
        Log::error('Error dispatching monthly reports: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
    }
})->timezone('Asia/Karachi')->everyFiveMinutes();

// Schedule::call(function () {
//     try {
//         Log::info('Scheduler is working at ' . now()->timezone('Asia/Karachi'));
//     } catch (\Throwable $e) {
//         Log::error('Error logging scheduler heartbeat: ' . $e->getMessage());
//     }
// })->timezone('Asia/Karachi')->everyMinute();
