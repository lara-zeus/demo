<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Symfony\Component\HttpFoundation\Response;

class SetLang
{
    public function handle(Request $request, Closure $next): Response
    {
        return app(StartSession::class)->handle($request, function ($request) use ($next) {
            if (request()->filled('lang')) {
                session()->put('current_lang', request('lang'));
            } elseif (!session()->has('current_lang')) {
                $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
                if (array_key_exists($locale, config('app.locales'))) {
                    session()->put('current_lang', $locale);
                }
            }

            app()->setLocale(session('current_lang', 'en'));

            return $next($request);
        });
    }
}
