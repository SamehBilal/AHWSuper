<?php

use Illuminate\Support\Facades\Route;
use Modules\Store\Http\Controllers\StoreController;
use Modules\Store\Http\Controllers\API\CustomersController;
use Modules\Store\Http\Controllers\API\ItemsController;
use Modules\Store\Http\Controllers\API\SalesOrdersController;
use Modules\Store\Http\Controllers\API\VendorsController;
use Modules\Store\Http\Controllers\API\PurchaseOrdersController;
use Modules\Store\Http\Controllers\API\InvoicesController;

Route::prefix('v1/store')->group(function () {
    Route::apiResource('items', ItemsController::class)->names('items.store');
    Route::apiResource('sales-orders', SalesOrdersController::class)->names('salesOrders.store');
    Route::post('sales-orders/{id}/status/confirmed', [SalesOrdersController::class, 'markAsConfirmed']);
    Route::post('sales-orders/{id}/status/void', [SalesOrdersController::class, 'markAsVoid']);
    Route::post('sales-orders/status/confirmed', [SalesOrdersController::class, 'bulkMarkAsConfirmed']);
    Route::apiResource('customers', CustomersController::class)->names('customers.store');
    Route::apiResource('vendors', VendorsController::class)->names('vendors.store');
    Route::apiResource('invoices', InvoicesController::class)->names('invoices.store');
    Route::apiResource('purchase-orders', PurchaseOrdersController::class)->names('purchaseOrders.store');
});

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('stores', StoreController::class)->names('store');
});
