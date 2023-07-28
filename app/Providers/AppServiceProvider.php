<?php

namespace App\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        FilamentAsset::register([
            Css::make('example-external-stylesheet', asset('css/flag-icons.css')),
        ]);
    }
}
