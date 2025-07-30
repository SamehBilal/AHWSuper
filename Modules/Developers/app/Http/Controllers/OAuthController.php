<?php

namespace Modules\Developers\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Passport\Http\Controllers\AuthorizationController as PassportAuthorizationController;
use Modules\Developers\Models\App;

class OAuthController extends PassportAuthorizationController
{
    public function authorize(Request $request)
    {
        // Find the app by client_id
        $clientId = $request->get('client_id');
        $app = App::whereHas('oauthClient', function($query) use ($clientId) {
            $query->where('id', $clientId);
        })->first();

        if (!$app || $app->status !== 'approved') {
            return response()->json(['error' => 'Application not found or not approved'], 404);
        }

        // Add app info to the authorization view
        $request->merge(['app' => $app]);

        return parent::authorize($request);
    }
}