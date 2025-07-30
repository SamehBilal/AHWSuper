<?php

use Illuminate\Support\Facades\Route;
use Modules\Developers\Http\Controllers\DevelopersController;
use Livewire\Volt\Volt;
use Modules\Developers\Http\Controllers\AppTesterController;
use Modules\Developers\Http\Controllers\OAuthController;

Route::middleware(['web'])->prefix('developers')->name('developers.')->group(function () {
    Volt::route('privacy-policy', 'theme.privacy-policy')->name('privacy');
    Volt::route('/', 'theme.index')
        ->name('index');

        Route::get('/oauth/authorize', [OAuthController::class, 'authorize'])->name('passport.authorizations.authorize');


    /* Route::get('/', function () {
        return view('developers::index');
    })->name('home'); */
});

Route::middleware(['auth', 'verified', 'two-factor'])->prefix('developers')->name('developers.')->group(function () {
    Volt::route('/apps', 'admin.apps')->name('apps');

    Route::prefix('admin')->group(function () {
        Volt::route('/dashboard', 'admin.index')->name('dashboard');
        Volt::route('/login-button', 'admin.login-button')->name('login-button');
        Volt::route('/app-verification', 'admin.app-verification')->name('app-verification');
        Volt::route('/oauth2', 'admin.oauth2')->name('oauth2');
        Volt::route('/app-testers', 'admin.app-testers')->name('app-testers');
        Volt::route('/apps', 'admin.apps.index')->name('apps.index');
        Volt::route('/apps/create', 'admin.apps.create')->name('apps.create');
        Volt::route('/apps/{app}/edit', 'admin.apps.create')->name('apps.edit');

        Route::get('/app-tester/{token}', [AppTesterController::class, 'show'])
            ->name('app-tester.show');
        Route::post('/app-tester/{token}/accept', [AppTesterController::class, 'accept'])
            ->name('app-tester.accept');
        Route::post('/app-tester/{token}/reject', [AppTesterController::class, 'reject'])
            ->name('app-tester.reject');


           /*  Route::middleware(['auth', 'app.tester'])->group(function () {
    Route::get('/apps/{app}/test-dashboard', [TestController::class, 'dashboard']);
    Route::get('/apps/{app}/beta-features', [TestController::class, 'beta']);
    Route::post('/apps/{app}/report-bug', [TestController::class, 'reportBug']);
}); */
    });
    Route::resource('developers', DevelopersController::class)->names('developers');
});
