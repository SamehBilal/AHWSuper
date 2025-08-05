<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UsersController;

Route::middleware(['auth:api'])->prefix('v1')->group(function () {
    Route::apiResource('users', UsersController::class)->names('users');
});
