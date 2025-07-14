<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Scalar\Laravel\Scalar;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/auth.php';
