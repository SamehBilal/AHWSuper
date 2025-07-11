<?php

use Illuminate\Support\Facades\Route;
use Modules\AHWStore\Http\Controllers\API\CustomersController;
use Modules\AHWStore\Http\Controllers\API\ItemsController;
use Modules\AHWStore\Http\Controllers\API\SalesOrdersController;
use Modules\AHWStore\Http\Controllers\API\VendorsController;
use Modules\AHWStore\Http\Controllers\API\PurchaseOrdersController;
use Modules\AHWStore\Http\Controllers\API\InvoicesController;

Route::prefix('v1/ahwstore')->group(function () {
    Route::apiResource('items', ItemsController::class)->names('items.ahwstore');
    Route::apiResource('sales-orders', SalesOrdersController::class)->names('salesOrders.ahwstore');
    Route::apiResource('customers', CustomersController::class)->names('customers.ahwstore');
    Route::apiResource('vendors', VendorsController::class)->names('vendors.ahwstore');
    Route::apiResource('invoices', InvoicesController::class)->names('invoices.ahwstore');
    Route::apiResource('purchase-orders', PurchaseOrdersController::class)->names('purchaseOrders.ahwstore');
});
