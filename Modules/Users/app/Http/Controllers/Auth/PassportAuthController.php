<?php

namespace Modules\Users\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Laravel\Passport\PersonalAccessTokenResult;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class PassportAuthController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login', /* 'register', 'forgetPassword', 'resetPassword', 'userSessions', 'OAuthRedirect', 'tokenDecode', 'authCodeDecode', 'OAuthCallBack' */]]);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'         => 'required|string|email',
            'password'      => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $response = Http::asForm()->post('http://localhost:8000/oauth/token', [
           'grant_type'    => 'password',
            'client_id' => '01980b3b-1a95-70cc-a5fd-bb95fcff9c62',
            'client_secret' => 'ZmlOlihezGrCNqPWdzeNCOiGQg60oEpxFsvsbocH',
            'username'      => $request->email,
            'password'      => $request->password,
            'scope'         => '*',
        ]);

       /*  $response = Http::timeout(10)->post('http://localhost:8000/oauth/token', [
            'grant_type'    => 'password',
            'client_id' => '01980b3b-1a95-70cc-a5fd-bb95fcff9c62',
            'client_secret' => 'ZmlOlihezGrCNqPWdzeNCOiGQg60oEpxFsvsbocH',
            'username'      => $request->email,
            'password'      => $request->password,
            'scope'         => '',
        ]);
 */
        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Error obtaining token from OAuth server.',
                'error'   => $response->body(),
            ], 500);
        }

        $token = json_decode((string) $response->getBody(), true);
        dd($token);

        $message = 'User logged in successfully';

        $expiresAt = now()->addSeconds($token['expires_in']);

        //return $this->respondWithToken($token['access_token'],  $token['refresh_token'], $message, $user, $token['expires_in']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed.',
                'error'   => $e->getMessage(),
            ], 500);
        }

        //dd($user);

        // Use Passport password grant to get a token
        /* Client ID  0197ef74-8842-7028-a83d-0b1931df7922
Client Secret  etvlBFAUB7OxjarLlyu01Mt4tvl61Xg0y
JZrfvU8 */
        /*Client ID  01980b3b-1a95-70cc-a5fd-bb95fcff9c62  
  Client Secret  ZmlOlihezGrCNqPWdzeNCOiGQg60oEpxFsvsbocH */

  
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
            //'client_id' => '0197f170-240f-724d-8c78-cd00431b6a4e',
            'client_id' => '01980b3b-1a95-70cc-a5fd-bb95fcff9c62',
            //'client_secret' => 'slzdUnOA2RuikzVuWthnyWs0CWHmxZW8VrKLpB0d', // Required for confidential clients only...
            'client_secret' => 'ZmlOlihezGrCNqPWdzeNCOiGQg60oEpxFsvsbocH', // Required for confidential clients only...
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
        ]);

        return $response->json();


        return response()->json([
            'token' => $data['access_token'],
            'expires_in' => $data['expires_in'],
            'refresh_token' => $data['refresh_token'] ?? null,
            'user' => $user,
        ]);
    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /* protected function respondWithToken($token, $refresh_token, $message, $user, $expires_in = null)
    {
        $randomString   = Str::random(40);
        $cookie         = cookie('authenticated', $randomString, 64800, null, '.arabhardware.com', true, false, false, 'None');
        $cookie1        = cookie('authenticated', $randomString, 64800, null, '.arabhardware.com', false, false, false, 'None');

        return response()->json([
            'status'        => 'success',
            'user'          => $user,
            'statusCode'    => 200,
            'message'       => $message,
            'authorization' => [
                'access_token'  => $token,
                'refresh_token' => $refresh_token,
                'token_type'    => 'bearer',
                'expires_in'    => $expires_in ?? auth('api')->factory()->getTTL()
            ],
        ], 200)->withCookie($cookie)->withCookie($cookie1);
    } */
}
