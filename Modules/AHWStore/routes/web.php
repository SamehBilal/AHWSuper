<?php

use Illuminate\Support\Facades\Route;
use Modules\AHWStore\Http\Controllers\AHWStoreController;
use Modules\AHWStore\Http\Controllers\Dashboard\ItemsController;
use Livewire\Volt\Volt;

Route::middleware(['auth', 'verified'])->prefix('ahwstore/')->name('ahwstore.')->group(function () {
    /* Route::resource('ahwstores', AHWStoreController::class)->names('ahwstore'); */
    Volt::route('customers', "customers.index")->name('customers.index');
    Volt::route('vendors', "vendors.index")->name('vendors.index');
    Volt::route('invoices', "invoices.index")->name('invoices.index');
    Volt::route('sales-orders', "sales-orders.index")->name('sales-orders.index');
    Volt::route('purchase-orders', "purchase-orders.index")->name('purchase-orders.index');
    Volt::route('items', "items.index")->name('items.index');
});
