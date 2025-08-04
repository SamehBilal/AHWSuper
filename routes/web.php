<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Scalar\Laravel\Scalar;

Route::get('/', function () {
    return view('welcome');
})->name('home');

/* Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'two-factor'])
    ->name('dashboard'); */

Route::redirect('dashboard', 'store/admin/dashboard')
    ->middleware(['auth', 'verified', 'two-factor'])
    ->name('dashboard.redirect');

require __DIR__.'/auth.php';
