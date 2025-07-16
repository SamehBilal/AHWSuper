<?php

use Illuminate\Support\Facades\Route;
use Modules\Roles\Http\Controllers\RolesController;
use Livewire\Volt\Volt;

Route::middleware(['auth', 'verified', 'two-factor'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Volt::route('settings/two-factor', 'settings.two-factor')->name('settings.two-factor');
    Volt::route('settings/sessions', 'settings.sessions')->name('settings.sessions');
    Volt::route('settings/users', 'settings.users')->name('settings.users');
    Route::resource('roles', RolesController::class)->names('roles');
});



require __DIR__.'/auth.php';
