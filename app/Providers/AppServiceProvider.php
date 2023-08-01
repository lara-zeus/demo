<?php

namespace App\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Blade;
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
            Css::make('filament-stylesheet', asset('css/filament.css')),
        ]);

        // I know! 🤷🏽‍, please let me have my fun!!!
        Blade::directive('stillCode', function () {
            return '<span class="title-font"><span class="title-font rounded-lg bg-gray-200 italic px-2 dark:bg-gray-500"><span class="title-font not-italic">Still ~ </span><span class="title-font not-italic text-purple-500">&lt;?</span><span> code</span><span class="title-font blink-cursor not-italic font-thin text-gray-400">|</span><span class="title-font not-italic text-purple-500">?&gt;</span></span></span>';
        });

        Blade::directive('zeus', function ($part = null) {
            return '<span class="font-koho text-gray-700 group"><span class="font-koho font-semibold text-primary-500 group-hover:text-secondary-500 transition ease-in-out duration-300">Lara&nbsp;<span class="font-koho line-through italic text-secondary-500 group-hover:text-primary-500 transition ease-in-out duration-300">Z</span>eus</span></span>'
            .($part) ?? '<span class="font-koho text-base tracking-wide text-gray-500">{$part}</span>';
        });

        Blade::directive('stillStats', function ($code) {
            if (!app()->isLocal()) {
                return '<!-- stats --><script async defer data-website-id="'.$code.'" src="https://stats.code.com/umami.js"></script>';
            }

            return '<!-- no tags for you -->';
        });
    }
}
