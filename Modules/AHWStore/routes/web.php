<?php

use Illuminate\Support\Facades\Route;
use Modules\AHWStore\Http\Controllers\AHWStoreController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('ahwstores', AHWStoreController::class)->names('ahwstore');
});
