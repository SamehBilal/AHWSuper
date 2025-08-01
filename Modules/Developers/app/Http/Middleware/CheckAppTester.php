<?php

namespace Modules\Developers\Http\Middleware;


use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Modules\Developers\Models\App;

class CheckAppTester
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $appId = $request->route('app');
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $app = App::findOrFail($appId);

        // Check if user is the app owner or an accepted tester
        $isOwner = $app->user_id === $user->id;
        $isTester = $app->testers()
            ->where('user_id', $user->id)
            ->where('status', 'accepted')
            ->exists();

        if (!$isOwner && !$isTester) {
            abort(403, 'You do not have access to test this application.');
        }

        return $next($request);
    }
}
