<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Modules\Roles\Http\Controllers\Auth\SocialAuthController;

Route::middleware('guest')->group(function () {

    Volt::route('login', 'auth.login')
        ->name('login');

    Volt::route('register', 'auth.register')
        ->name('register');

    Volt::route('forgot-password', 'auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'auth.reset-password')
        ->name('password.reset');

    Route::get('login/{provider}', [SocialAuthController::class, 'redirectToProvider'])
    ->name('social.login');

    Route::get('login/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);

    Route::get('available-drivers', [SocialAuthController::class, 'getAvailableDrivers'])
    ->name('social.available-drivers');

    
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'auth.confirm-password')
        ->name('password.confirm');

    Volt::route('two-factor-verify', 'auth.two-factor-verify')
        ->middleware(['has-two-factor'])
        ->name('two-factor-verify');
});

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');
