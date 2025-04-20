<?php

use App\Livewire\AddExpense;
use App\Livewire\ViewExpenses;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', Welcome::class)->name('dashboard');
    Route::get('/expenses/add-expenses', AddExpense::class)->name('add.expense');
    Route::get('/expenses', ViewExpenses::class)->name('view.expenses');
});


require __DIR__.'/auth.php';
