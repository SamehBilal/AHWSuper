<?php

use Illuminate\Support\Facades\Route;
use Modules\Invoices\Http\Controllers\InvoicesController;

use Livewire\Volt\Volt;

Route::middleware(['auth', 'verified', 'two-factor'])->prefix('invoices/admin')->name('invoices.')->group(function () {
    
    Volt::route('dashboard', "invoices.dashboard")->name('dashboard');
});

Route::resource('invoices', InvoicesController::class)->names('invoices');

