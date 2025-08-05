<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UsersController;
use Livewire\Volt\Volt;

Route::middleware(['auth', 'verified', 'two-factor'])->prefix('users/admin')->name('users.')->group(function () {
    Route::redirect('settings', 'settings/profile');
    
    Volt::route('dashboard', "users.dashboard")->name('dashboard');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Volt::route('settings/two-factor', 'settings.two-factor')->name('settings.two-factor');
    Volt::route('settings/sessions', 'settings.sessions')->name('settings.sessions');
    Volt::route('settings/users', 'settings.users')->name('settings.users');
});
Route::resource('users', UsersController::class)->names('users');


require __DIR__.'/auth.php';
