<?php

namespace Modules\Roles\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HasTwoFactorSecret
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->two_factor_secret && !Auth::user()->two_factor_confirmed_at) {
            return $next($request);
        }

        return redirect()->route('dashboard');
    }
}
