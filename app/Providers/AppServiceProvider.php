<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\CarbonInterval;
use App\Models\User;
use Illuminate\Support\Facades\Gate;


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
        Passport::authorizationView(function ($parameters) {
            return view('roles::livewire.auth.authorize1', [
            'client' => $parameters['client'],
            'user' => $parameters['user'],
            'scopes' => $parameters['scopes'],
            'request' => $parameters['request'],
            'authToken' => $parameters['authToken'],
        ]);});

        Passport::loadKeysFrom(__DIR__ . '/../secrets/oauth');
        Passport::tokensExpireIn(CarbonInterval::days(15));
        Passport::refreshTokensExpireIn(CarbonInterval::days(30));
        Passport::personalAccessTokensExpireIn(CarbonInterval::months(6));
        Passport::enablePasswordGrant();
        Passport::enableImplicitGrant();

        Gate::define('viewScalar', function (?User $user) {
            return in_array($user->email, [
                'sameh.bilal@outlook.com'
            ]);
        });
    }
}
