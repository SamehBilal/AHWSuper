<?php

use Illuminate\Support\Facades\Route;
use Modules\Ads\Http\Controllers\AdsController;

Route::middleware(['auth:api'])->prefix('v1')->group(function () {
    Route::apiResource('ads', AdsController::class)->names('ads');
});
