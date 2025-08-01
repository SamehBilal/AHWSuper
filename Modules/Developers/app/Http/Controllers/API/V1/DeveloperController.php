<?php

namespace Modules\Developers\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Developers\Models\App;
use Modules\Developers\Models\ApiKey;
use Modules\Developers\Services\AppService as DeveloperAppService;

class TesterApiController extends Controller
{
    protected $appService;

    public function __construct(DeveloperAppService $appService)
    {
        $this->appService = $appService;
        $this->middleware('auth:api');
    }

    public function apps()
    {
        return response()->json([
            'apps' => auth()->user()->developerApps()->with(['reviews', 'apiKeys'])->get(),
            'stats' => [
                'total' => auth()->user()->developerApps()->count(),
                'approved' => auth()->user()->developerApps()->where('status', 'approved')->count(),
                'pending' => auth()->user()->developerApps()->where('status', 'pending')->count(),
            ]
        ]);
    }

    public function show(App $app)
    {
        $this->authorize('view', $app);

        return response()->json([
            'app' => $app->load(['reviews', 'apiKeys', 'webhooks']),
            'analytics' => $this->appService->getAppAnalytics($app),
            'client_credentials' => [
                'client_id' => $app->getClientId(),
                'client_secret' => $app->status === 'approved' ? $app->getClientSecret() : null,
            ]
        ]);
    }

    public function createApiKey(Request $request, App $app)
    {
        $this->authorize('update', $app);

        $request->validate([
            'name' => 'required|string|max:255',
            'rate_limit' => 'integer|min:100|max:10000',
            'allowed_ips' => 'array',
            'allowed_ips.*' => 'ip',
            'allowed_scopes' => 'array',
        ]);

        $apiKey = ApiKey::create([
            'app_id' => $app->id,
            'name' => $request->name,
            'rate_limit' => $request->rate_limit ?? 1000,
            'allowed_ips' => $request->allowed_ips,
            'allowed_scopes' => $request->allowed_scopes,
        ]);

        return response()->json([
            'message' => 'API key created successfully',
            'api_key' => $apiKey,
            'key' => $apiKey->key, // Only show the key once
        ], 201);
    }

    public function revokeApiKey(App $app, ApiKey $apiKey)
    {
        $this->authorize('update', $app);

        if ($apiKey->app_id !== $app->id) {
            return response()->json(['error' => 'API key not found'], 404);
        }

        $apiKey->update(['is_active' => false]);

        return response()->json(['message' => 'API key revoked successfully']);
    }
}
