<?php

namespace App\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentView;
use Illuminate\Contracts\View\View;
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
        $this->hooksRenderer();

        FilamentAsset::register([
            Css::make('example-external-stylesheet', asset('css/flag-icons.css')),
            Css::make('filament-stylesheet', asset('css/filament.css')),
        ]);

        // I know! 🤷🏽‍, please let me have my fun!!!
        Blade::directive('stillCode', function () {
            return '<span class="font-courier"><span class="font-courier rounded-lg bg-gray-200 italic px-2 dark:bg-gray-500"><span class="font-courier not-italic">Still ~ </span><span class="font-courier not-italic text-purple-500">&lt;?</span><span> code</span><span class="font-courier blink-cursor not-italic font-thin text-gray-400">|</span><span class="font-courier not-italic text-purple-500">?&gt;</span></span></span>';
        });

        Blade::directive('zeus', function ($part = null) {
            return '<span class="title-font text-gray-700 group"><span class="title-font font-semibold text-primary-500 group-hover:text-secondary-500 transition ease-in-out duration-300">Lara&nbsp;<span class="title-font line-through italic text-secondary-500 group-hover:text-primary-500 transition ease-in-out duration-300">Z</span>eus</span></span>'
            .($part) ?? '<span class="title-font text-base tracking-wide text-gray-500">{$part}</span>';
        });

        Blade::directive('stillStats', function ($code) {
            if (! app()->isLocal()) {
                return '<!-- stats --><script async defer data-website-id="'.$code.'" src="https://stats.still-code.com/script.js"></script>';
            }

            return '<!-- no tags for you -->';
        });
    }

    public function hooksRenderer()
    {
        $hooks = [
            'zeus-forms.before',
            'zeus-forms.after',
            'zeus-form.before',
            'zeus-form.after',
            'zeus-form-section.before',
            'zeus-form-section.after',
            'zeus-form-field.before',
            'zeus-form-field.after',
        ];

        foreach ($hooks as $key => $hook) {
            FilamentView::registerRenderHook(
                "$hook",
                fn (): View => view('filament.hooks.placeholder', ['data' => "$hook"]),
            );
        }
    }
}
