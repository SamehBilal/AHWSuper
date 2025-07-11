<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Laravel\Passport\PersonalAccessTokenResult;
use Illuminate\Support\Facades\Http;

class PassportAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        //dd($user);

        // Use Passport password grant to get a token
        /* Client ID  0197ef74-8842-7028-a83d-0b1931df7922

  Client Secret  etvlBFAUB7OxjarLlyu01Mt4tvl61Xg0y
JZrfvU8 */
        // Use Laravel's HTTP client instead of GuzzleHttp\Client
       /*  $response = Http::asForm()->post(config('services.passport.login_endpoint', '/oauth/token'), [
            'grant_type' => 'password',
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
        ]); */

        $response = Http::asForm()->post('http://localhost:8000/oauth/token', [
            'grant_type' => 'password',
            'client_id' => '0197f170-240f-724d-8c78-cd00431b6a4e',
            'client_secret' => 'slzdUnOA2RuikzVuWthnyWs0CWHmxZW8VrKLpB0d', // Required for confidential clients only...
            'redirect_url' => "http://localhost:8000/api/auth/callback",
            'username' => $request->email,
            'password' => $request->password,
            'scope' => 'user:read orders:create',
        ]);

        return $response->json();


        return response()->json([
            'token' => $data['access_token'],
            'expires_in' => $data['expires_in'],
            'refresh_token' => $data['refresh_token'] ?? null,
            'user' => $user,
        ]);
    }
}
