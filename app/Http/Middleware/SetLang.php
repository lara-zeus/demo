<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\URL;

class SetLang
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);

        return app(StartSession::class)->handle($request, function ($request) use ($next) {

            /*if(!in_array($request->segment(1), config('app.locales'))){
                session()->put('current_lang', 'en');
                app()->setLocale(session('current_lang'));
                return redirect(
                    str($request->url())
                        ->replace(config('app.url'), config('app.url').'/en')
                );
            }*/

            /*if (in_array($request->segment(1), config('app.locales'))) {
                session()->put('current_lang', $request->segment(1));
            }

            app()->setLocale(session('current_lang'));*/

            return $next($request);
        });
    }
}
