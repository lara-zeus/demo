<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use LaraZeus\Core\CoreServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class SetTheme
{
    public function handle(Request $request, Closure $next): Response
    {
        return app(StartSession::class)->handle($request, function ($request) use ($next) {
            if (session()->has('current_theme')) {
                if (array_key_exists(session('current_theme', 'zeus'), config('zeus.themes'))) {
                    $getTheme = config('zeus.themes')[session('current_theme', 'zeus')];
                    config(['zeus.layout' => $getTheme]);
                    config(['zeus.theme' => session('current_theme', 'zeus')]);

                    $viewPath = 'zeus::themes.' . config('zeus.theme');
                    View::share('artemis' . 'Theme', $viewPath);
                    App::singleton('artemis' . 'Theme', function () use ($viewPath) {
                        return $viewPath;
                    });

                    $pkg = str($request->path())->explode('/')->first();
                    CoreServiceProvider::setThemePath($pkg);
                }
            } else {
                session()->put('current_theme', 'zeus');
            }

            return $next($request);
        });
    }
}
