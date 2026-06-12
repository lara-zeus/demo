<?php

ini_set('memory_limit', '-1');

use App\Http\Middleware\SetLang;
use App\Http\Middleware\SetTheme;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Livewire\Exceptions\ComponentNotFoundException;
use Livewire\Exceptions\MaxNestingDepthExceededException;
use Livewire\Mechanisms\HandleComponents\CorruptComponentPayloadException;
use Sentry\Laravel\Integration;
use Torchlight\Middleware\RenderTorchlight;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append([
            SetLang::class,
            SetTheme::class,
            RenderTorchlight::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        Integration::handles($exceptions);

        $exceptions->dontReport([
            MaxNestingDepthExceededException::class,
            CorruptComponentPayloadException::class,
            ComponentNotFoundException::class,
        ]);

        $exceptions->reportable(function (TypeError $e) {
            if (str_contains($e->getMessage(), 'Filament\Notifications\Collection')) {
                return false;
            }
        });
    })->create();
