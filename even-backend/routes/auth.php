<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('login', 'auth.login')
        ->name('login');
    Route::redirect('/register', '/login');
    Route::redirect('/forgot-password', '/login');
    Route::redirect('/reset-password/{token}', '/login');

});

Route::middleware('auth')->group(function () {
    Route::redirect('/verify-email', '/login');
    Route::redirect('/verify-email/{id}/{hash}', '/login');
    Route::redirect('/confirm-password', '/login');
});

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');
