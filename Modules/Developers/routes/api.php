<?php

use Illuminate\Support\Facades\Route;
use Modules\Developers\Http\Controllers\API\V1\TesterApiController;

Route::middleware(['auth:sanctum'])->group(function () {
    // Tester management API endpoints
    Route::prefix('apps/{app}/testers')->group(function () {
        Route::get('/', [TesterApiController::class, 'index']);
        Route::post('/', [TesterApiController::class, 'store']);
        Route::delete('/{tester}', [TesterApiController::class, 'destroy']);
        Route::post('/{tester}/resend', [TesterApiController::class, 'resend']);
    });

    // Tester invitation responses
    Route::post('/invitations/{token}/accept', [TesterApiController::class, 'accept']);
    Route::post('/invitations/{token}/reject', [TesterApiController::class, 'reject']);
});

Route::middleware('api.key')->prefix('v1')->group(function () {
    //
});
