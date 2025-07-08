<?php

namespace Modules\Roles\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    protected $allowedProviders = [
        'github', 'google', 'facebook', 'twitter', 'linkedin', // ...add all your providers here
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

        dd($socialUser);

        // Find or create user logic
        $user = User::firstOrCreate(
            ['provider_id' => $socialUser->getId(), 'provider' => $provider],
            [
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                // ...other fields
            ]
        );

        Auth::login($user, true);

        return redirect()->intended('/dashboard');
    }
}
