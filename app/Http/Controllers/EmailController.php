<?php

namespace App\Http\Controllers;

use App\Jobs\SendExpenseReportMonthlyJob;
use App\Models\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendExpenseReport(Request $request)
    {
        $user = auth()->user();
        $filters = [
            'period' => $request->input('period', 'current_month'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'status' => $request->input('status', 'all'),
            'debtFilter' => $request->input('debtFilter', 'all'),
        ];


        SendExpenseReportMonthlyJob::dispatch($user, $filters);

        return redirect()->back()->with('success', 'Expense report email sent!');
    }
}
