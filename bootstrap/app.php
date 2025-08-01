<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Modules\Roles\Http\Middleware\HasTwoFactorSecret;
use Modules\Roles\Http\Middleware\TwoFactorAuthenticator;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'two-factor'        => TwoFactorAuthenticator::class,
            'has-two-factor'    => HasTwoFactorSecret::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                // Validation errors
                if ($e instanceof \Illuminate\Validation\ValidationException) {
                    return response()->json([
                        'message' => $e->getMessage(),
                        'errors' => $e->errors(),
                    ], 422);
                }

                // Authentication errors
                if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                    return response()->json([
                        'message' => 'Unauthenticated.',
                    ], 401);
                }

                // All other errors
                return response()->json([
                    'message' => $e->getMessage(),
                ], method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500);
            }

            // Handle unauthenticated web requests for modules
            if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                // Match the first segment as the module name
                $path = ltrim($request->path(), '/');
                $segments = explode('/', $path);
                $module = $segments[0] ?? null;
                // List your module names here as needed
                $modules = ['developers', 'roles', 'ahwstore'];
                if ($module && in_array($module, $modules)) {
                    if ($module === 'roles') {
                        // Exception: roles module goes to login without 'from'
                        return redirect()->guest(route('login'));
                    } else {
                        return redirect()->guest(route('login', ['from' => $module]));
                    }
                }
                // Default behavior
                return redirect()->guest(route('login'));
            }
        });
    })
    ->create();
