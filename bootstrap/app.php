<?php

use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'verify.token' => TokenVerificationMiddleware::class,
            'email_otp' => TokenVerificationMiddleware::class,
            'verify_otp' => TokenVerificationMiddleware::class,
            'role'=> RoleMiddleware::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
