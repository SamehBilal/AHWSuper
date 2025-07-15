<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\Roles\Http\Controllers\Auth\PassportAuthController;
use Illuminate\Support\Str;

Route::post('/auth/passport/login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->get('/passport-user', function (Request $request) {
    return $request->user();
});


Route::middleware(['web'])->group(function () {
    Route::get('/redirect', function (Request $request) {
        $request->session()->put('state', $state = Str::random(40));

        $request->session()->put(
            'code_verifier',
            $codeVerifier = Str::random(128)
        );

        $codeChallenge = strtr(rtrim(
            base64_encode(hash('sha256', $codeVerifier, true))
            ,
            '='
        ), '+/', '-_');

        $query = http_build_query([
            'client_id' => '01980b5d-8c07-725b-a68a-7e35eb706ac2',
            'redirect_uri' => 'http://localhost:8000/api/auth/callback',
            'response_type' => 'code',
            'scope' => '*',
            'state' => $state,
            'code_challenge' => $codeChallenge,
            'code_challenge_method' => 'S256',
            // 'prompt' => '', // "none", "consent", or "login"
        ]);

        return redirect('http://localhost:8000/oauth/authorize?' . $query);
    });



    Route::get('/auth/callback', function (Request $request) {
        $state = $request->session()->pull('state');

        $codeVerifier = $request->session()->pull('code_verifier');

        //dd([$codeVerifier, $request->code]);

        throw_unless(
            strlen($state) > 0 && $state === $request->state,
            InvalidArgumentException::class
        );

        try {
             // Create internal request instead of HTTP request
             $tokenRequest = Request::create('/oauth/token', 'POST', [
                'grant_type' => 'authorization_code',
                'client_id' => '01980b5d-8c07-725b-a68a-7e35eb706ac2',
                'redirect_uri' => 'http://localhost:8000/api/auth/callback',
                'code_verifier' => $codeVerifier,
                'code' => $request->code,
            ]);

            $tokenRequest->headers->set('Accept', 'application/json');
            $tokenRequest->headers->set('Content-Type', 'application/x-www-form-urlencoded');

            $response = app()->handle($tokenRequest);
            
            return response()->json(json_decode($response->getContent(), true));
            /* $response = Http::timeout(60)->asForm()->post('http://localhost:8000/oauth/token', [
                'grant_type' => 'authorization_code',
                'client_id' => '01980b5d-8c07-725b-a68a-7e35eb706ac2',
                'redirect_uri' => 'http://localhost:8000/api/auth/callback',
                'code_verifier' => $codeVerifier,
                'code' => $request->code,
            ]);

            return $response->json(); */
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $request->code,
                'state' => $request->state,
            ]);
        }
    });
});