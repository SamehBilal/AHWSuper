<?php

use Illuminate\Support\Facades\Route;
use Modules\Invoices\Http\Controllers\InvoicesController;

Route::middleware(['auth:api'])->prefix('v1')->group(function () {
    Route::apiResource('invoices', InvoicesController::class)->names('invoices');
});
