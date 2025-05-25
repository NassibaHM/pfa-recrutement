<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
            'candidat' => \App\Http\Middleware\CandidatMiddleware::class,
            'restrict.applications' => \App\Http\Middleware\RestrictMultipleApplications::class, // Added
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
