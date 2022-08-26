<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        Filament::serving(function () {
            //Filament::registerTheme(asset('vendor/zeus/app.css'));
            Filament::registerTheme(mix('css/app.css'));
        });

        Filament::registerRenderHook(
            'global-search.end',
            fn (): View => view('filament.hooks.lang-switcher'),
        );
    }
}
