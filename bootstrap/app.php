<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append([
            \App\Http\Middleware\SetLang::class,
            \App\Http\Middleware\SetTheme::class,
            \Torchlight\Middleware\RenderTorchlight::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->reportable(function (Throwable $e) {
            if ($this->shouldReport($e) && app()->bound('sentry')) {
                app('sentry')->captureException($e);
            }
        });

        \Sentry\Laravel\Integration::handles($exceptions);
    })->create();
