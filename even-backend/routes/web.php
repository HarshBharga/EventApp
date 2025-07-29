<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\ManageEvent;

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');


Route::get('dashboard', function () {
    return redirect()->route('events');
})->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Route::get('/events', ManageEvent::class)->name('events');
});


require __DIR__.'/auth.php';
