<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;

class SetLang
{
    public function handle(Request $request, Closure $next)
    {
        return app(StartSession::class)->handle($request, function ($request) use ($next) {
            if (session()->has('current_lang')) {
                app()->setLocale(session('current_lang'));
            }

            return $next($request);
        });
    }
}
