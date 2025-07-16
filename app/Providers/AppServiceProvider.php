<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\CarbonInterval;
use Livewire\Livewire;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // By providing a view name...
        Passport::authorizationView(function ($parameters) {
            return view('roles::livewire.auth.authorize1', [
            'client' => $parameters['client'],
            'user' => $parameters['user'],
            'scopes' => $parameters['scopes'],
            'request' => $parameters['request'],
            'authToken' => $parameters['authToken'],
        ]);});
        /* Passport::authorizationView(function ($parameters) {
            return view('roles::authorize', [
                'client' => $parameters['client'],
                'user' => $parameters['user'],
                'scopes' => $parameters['scopes'],
                'request' => $parameters['request'],
                'authToken' => $parameters['authToken'],
            ]);
            return Livewire::mount('auth.authorize', [
                'client' => $parameters['client'],
                'user' => $parameters['user'],
                'scopes' => $parameters['scopes'],
                'request' => $parameters['request'], // This will be used in mount() only
                'authToken' => $parameters['authToken'] ?? null,
            ]);
        }); */

        // By providing a closure...
        /* Passport::authorizationView(
            fn($parameters) => Inertia::render('Auth/OAuth/Authorize', [
                'request' => $parameters['request'],
                'authToken' => $parameters['authToken'],
                'client' => $parameters['client'],
                'user' => $parameters['user'],
                'scopes' => $parameters['scopes'],
            ])
        ); */

        Passport::loadKeysFrom(__DIR__ . '/../secrets/oauth');
        Passport::tokensExpireIn(CarbonInterval::days(15));
        Passport::refreshTokensExpireIn(CarbonInterval::days(30));
        Passport::personalAccessTokensExpireIn(CarbonInterval::months(6));
        Passport::enablePasswordGrant();
        Passport::enableImplicitGrant();
    }
}
