<?php

use Illuminate\Support\Facades\Route;
use Modules\Developers\Http\Controllers\DevelopersController;
use Livewire\Volt\Volt;


Route::middleware(['web'])->prefix('developers')->name('developers.')->group(function () {
    Volt::route('privacy-policy', 'theme.privacy-policy')->name('privacy');
    Volt::route('/', 'theme.index')
    ->name('index');

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
        Volt::route('/general-information', 'admin.general-information')->name('general-information');
        Volt::route('/apps', 'admin.apps.index')->name('apps.index');
        Volt::route('/apps/create', 'admin.apps.create')->name('apps.create');
        Volt::route('/apps/{app}/edit', 'admin.apps.edit')->name('apps.edit');
    });
    Route::resource('developers', DevelopersController::class)->names('developers');
});
