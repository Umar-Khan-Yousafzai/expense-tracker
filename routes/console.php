<?php

use App\Jobs\SendExpenseReportMonthlyJob;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;
use Carbon\Carbon;
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Monthly report dispatch
Schedule::call(function () {
    try {
        Log::info('📤 Starting monthly expense report dispatch...');
        $users = User::all();
        $tz = 'Asia/Karachi';
        $start = Carbon::now($tz)->subMonth()->startOfMonth()->startOfDay()->toDateTimeString();
        $end = Carbon::now($tz)->subMonth()->endOfMonth()->endOfDay()->toDateTimeString();

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
        Log::info('✅ Monthly expense reports dispatched to ' . count($users) . ' users.');
    } catch (\Throwable $e) {
        Log::error('❌ Error dispatching monthly reports: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
    }
})->timezone('Asia/Karachi')->monthlyOn(2, '06:00'); // <-- Adjust the day as needed

// Every minute heartbeat
Schedule::call(function () {
    try {
        Log::info('✅ Scheduler is working at ' . now()->timezone('Asia/Karachi'));
    } catch (\Throwable $e) {
        Log::error('❌ Error logging scheduler heartbeat: ' . $e->getMessage());
    }
})->timezone('Asia/Karachi')->everyMinute();
