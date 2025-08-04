<?php

use Illuminate\Support\Facades\Route;
use Modules\Store\Http\Controllers\StoreController;
use Livewire\Volt\Volt;


Route::middleware(['auth', 'verified', 'two-factor'])->prefix('store/admin')->name('store.')->group(function () {
    /*     Route::resource('stores', StoreController::class)->names('store'); */
    
    // Use Volt routes with custom layout
    Volt::route('dashboard', "dashboard")->name('dashboard');
    Volt::route('customers', "customers.index")->name('customers.index');
    Volt::route('vendors', "vendors.index")->name('vendors.index');
    Volt::route('invoices', "invoices.index")->name('invoices.index');
    Volt::route('sales-orders/create', "sales-orders.create")->name('sales-orders.create');
    Volt::route('sales-orders', "sales-orders.index")->name('sales-orders.index');
    Volt::route('purchase-orders', "purchase-orders.index")->name('purchase-orders.index');
    Volt::route('items', "items.index")->name('items.index');
});