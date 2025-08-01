<?php

namespace Modules\Developers\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Modules\Developers\Models\ApiKey;
use Modules\Developers\Models\App;
use Modules\Developers\Models\AppAnalytic;

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

        $recentRequests = AppAnalytic::where('app_id', $key->app_id)
            ->where('created_at', '>=', now()->subHour())
            ->count();

        if ($recentRequests >= $key->rate_limit) {
            return response()->json(['error' => 'Rate limit exceeded'], 429);
        }

        // Check IP restrictions
        if ($key->allowed_ips && !in_array($request->ip(), $key->allowed_ips)) {
            return response()->json(['error' => 'IP address not allowed'], 403);
        }

        // Update last used timestamp
        $key->update(['last_used_at' => now()]);

        // Log request for analytics
        $startTime = microtime(true);

        $response = $next($request);

        // Calculate response time
        $responseTime = (microtime(true) - $startTime) * 1000;

        // Log analytics
        AppAnalytic::create([
            'app_id' => $key->app_id,
            'user_id' => auth('api')->id(),
            'endpoint' => $request->path(),
            'method' => $request->method(),
            'status_code' => $response->getStatusCode(),
            'response_time_ms' => round($responseTime),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'request_data' => $request->method() === 'GET' ? $request->query() : $request->all(),
        ]);

        // Add app context to request
        $request->merge(['api_app' => $key->app]);

        return $response;

        //return $next($request);
    }
}
