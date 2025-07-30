<?php

namespace Modules\Developers\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Modules\Developers\Models\ApiKey;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-Key') ?? $request->get('api_key');
        
        if (!$apiKey) {
            return response()->json(['error' => 'API key required'], 401);
        }

        $key = ApiKey::where('key', $apiKey)
            ->where('is_active', true)
            ->with('app')
            ->first();

        if (!$key || $key->app->status !== 'approved') {
            return response()->json(['error' => 'Invalid API key'], 401);
        }

        // Update last used
        $key->update(['last_used_at' => now()]);

        // Add app context to request
        $request->merge(['api_app' => $key->app]);

        return $next($request);
    }
}
