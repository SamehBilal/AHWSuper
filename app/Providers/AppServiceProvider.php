<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\CarbonInterval;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Modules\Developers\Models\App;
use Modules\Developers\Models\AuthCode;
use Modules\Developers\Models\Client;
use Modules\Developers\Models\DeviceCode;
use Modules\Developers\Models\RefreshToken;
use Modules\Developers\Models\Token;
use Modules\Developers\Policies\AppPolicy;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        App::class => AppPolicy::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        // Register the AppPolicy
        /* $this->app['auth']->registerPolicies($this->policies);

        // Register the AppService
        $this->app->singleton('AppService', function ($app) {
            return new \Modules\Developers\Services\AppService();
        }); */
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::authorizationView(function ($parameters) {
            return view('users::livewire.auth.authorize1', [
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

        Passport::useTokenModel(Token::class);
        Passport::useRefreshTokenModel(RefreshToken::class);
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::useClientModel(Client::class);
        Passport::useDeviceCodeModel(DeviceCode::class);

        Gate::define('viewScalar', function (?User $user) {
            return in_array($user->email, [
                'sameh.bilal@outlook.com'
            ]);
        });
    }

}
