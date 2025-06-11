<?php
// use App\Http\Controllers\Auth\VerifyEmailController;
// use App\Livewire\Auth\ConfirmPassword;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
// use App\Livewire\Auth\ResetPassword;
// use App\Livewire\Auth\VerifyEmail;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
    // Route::get('forgot-password', ForgotPassword::class)->name('password.request');
    // Route::get('reset-password/{token}', ResetPassword::class)->name('password.reset');
});

Route::get('/logout', function () {
    /**
    * @disregard
    */
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
});