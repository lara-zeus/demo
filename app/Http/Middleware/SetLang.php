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
            if (request()->filled('lang') && is_array(config('app.locales')) && array_key_exists(request('lang'), config('app.locales'))) {
                session()->put('current_lang', request('lang'));
            } elseif (! session()->has('current_lang')) {
                $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE', ''), 0, 2);
                if (is_array(config('app.locales')) && array_key_exists($locale, config('app.locales'))) {
                    session()->put('current_lang', $locale);
                }
            }

            $currentLang = session('current_lang', 'en');
            if (is_array(config('app.locales')) && ! array_key_exists($currentLang, config('app.locales'))) {
                $currentLang = 'en';
            }
            app()->setLocale($currentLang);

            return $next($request);
        });
    }
}
