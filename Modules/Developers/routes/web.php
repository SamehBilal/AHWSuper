<?php

use Illuminate\Support\Facades\Route;
use Modules\Developers\Http\Controllers\DevelopersController;
use Livewire\Volt\Volt;


Route::middleware(['web'])->prefix('developers')->name('developers.')->group(function () {
    Volt::route('privacy-policy', 'theme.privacy-policy')->name('privacy');
    Volt::route('/', 'theme.index')
    ->name('index');

    /* Route::get('/', function () {
        return view('developers::index');
    })->name('home'); */

});

Route::middleware(['auth', 'verified', 'two-factor'])->prefix('developers')->name('developers.')->group(function () {
    Volt::route('/dashboard', 'admin.index')->name('dashboard');
    Volt::route('/apps', 'admin.apps')->name('apps');
    Volt::route('/login-button', 'admin.login-button')->name('login-button');
    Route::resource('developers', DevelopersController::class)->names('developers');
});
