<?php

use Illuminate\Support\Facades\Route;
use Modules\Roles\Http\Controllers\RolesController;

Route::middleware(['auth:api'])->prefix('v1')->group(function () {
    Route::apiResource('roles', RolesController::class)->names('roles');
});
