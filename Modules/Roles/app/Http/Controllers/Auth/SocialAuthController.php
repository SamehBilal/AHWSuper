<?php

namespace Modules\Roles\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SocialAuthController extends Controller
{
    protected $allowedProviders = [
        'github',
        'google',
        'facebook',
        'x',
        'apple',
        'amazon',
        'microsoft',
        'slack',
        'linkedin',
        'twitch',
        'tiktok',
        'discord',
    ];

    public function redirectToProvider($provider)
    {
        if (!in_array($provider, $this->allowedProviders)) {
            abort(404);
        }
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        if (!in_array($provider, $this->allowedProviders)) {
            abort(404);
        }

        $socialUser = Socialite::driver($provider)->user();

        //dd($socialUser);

        $providerData = [
            'provider_id' => $socialUser->getId(),
            'provider' => $provider,
        ];

        $user = User::where('provider', '!=', null)
            ->get()
            ->filter(function ($user) use ($providerData) {
                $providers = $user->provider ?? [];
                return collect($providers)->contains(function ($provider) use ($providerData) {
                    return $provider['provider'] === $providerData['provider'] &&
                           $provider['provider_id'] === $providerData['provider_id'];
                });
            })
            ->first();

        if ($user) {
            $user->update([
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
            ]);
        } else {
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                $providers = $user->provider ?? [];

                $providers = array_filter($providers, fn($p) => $p['provider'] !== $provider);

                $providers[] = $providerData;

                $user->update([
                    'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                    'provider' => array_values($providers),
                ]);
            } else {
                $user = User::create([
                    'name'      => $socialUser->getName() ?? $socialUser->getNickname(),
                    'email'     => $socialUser->getEmail(),
                    'password'  => Hash::make('12345678'),
                    'provider'  => [$providerData],
                ]);
            }
        }

        Auth::login($user, true);

        return redirect()->intended('/dashboard');
    }

    /**
     * Get list of available Socialite drivers
     */
    public function getAvailableDrivers()
    {
        $drivers = [];

        $commonDrivers = [
            'github', 'google', 'facebook', 'twitter', 'linkedin',
            'bitbucket', 'gitlab', 'dropbox', 'x', 'apple', 'amazon',
            'microsoft', 'slack', 'twitch', 'tiktok', 'discord'
        ];

        foreach ($commonDrivers as $driver) {
            try {
                Socialite::driver($driver);
                $drivers[] = $driver;
            } catch (\Exception $e) {
                // Driver not available
            }
        }

        return response()->json([
            'available_drivers' => $drivers,
            'your_allowed_providers' => $this->allowedProviders,
            'message' => 'Drivers marked as available are either built-in or have SocialiteProviders packages installed'
        ]);
    }
}
