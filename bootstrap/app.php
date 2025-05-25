<?php

use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->encryptCookies(except: ['appearance']);

        $middleware->web(append: [
            HandleAppearance::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->alias([
            'scopes' => Laravel\Passport\Http\Middleware\CheckScopes::class,
            'scope' => Laravel\Passport\Http\Middleware\CheckForAnyScope::class,
            'clients' => Laravel\Passport\Http\Middleware\CheckClientCredentials::class,
            'client' => Laravel\Passport\Http\Middleware\CheckClientCredentialsForAnyScope::class,
            'roles' => App\Http\Middleware\CheckRoles::class,
            'role' => App\Http\Middleware\CheckForAnyRole::class,
            'permission' => App\Http\Middleware\CheckPermission::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
