<?php

use Illuminate\Support\Facades\Route;
use Modules\Ads\Http\Controllers\AdsController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('ads', AdsController::class)->names('ads');
});
