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

            if (!session()->has('current_lang')) {
                $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
                if (array_key_exists($locale, config('app.locales'))) {
                    session()->put('current_lang', $locale);
                } else {
                    session()->put('current_lang', 'en');
                }
            }

            app()->setLocale(session('current_lang'));

            return $next($request);
        });
    }
}
