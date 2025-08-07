<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Scalar\Laravel\Scalar;

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::middleware(['auth', 'verified', 'two-factor'])->prefix('admin/')->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Volt::route('settings/two-factor', 'settings.two-factor')->name('settings.two-factor');
    Volt::route('settings/sessions', 'settings.sessions')->name('settings.sessions');
    Volt::route('settings/users', 'settings.users')->name('settings.users');
});

require __DIR__ . '/auth.php';
