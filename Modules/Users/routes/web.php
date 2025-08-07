<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UsersController;
use Livewire\Volt\Volt;

Route::middleware(['auth', 'verified', 'two-factor'])->prefix('users/admin')->name('users.')->group(function () {

    Volt::route('dashboard', "users.dashboard")->name('dashboard');
    
});
Route::resource('users', UsersController::class)->names('users');


require __DIR__.'/auth.php';
