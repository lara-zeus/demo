<?php

namespace App\Providers;

use BezhanSalleh\PanelSwitch\PanelSwitch;
use Filament\Facades\Filament;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentColor;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\View\Components\Modal;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::automaticallyEagerLoadRelationships();

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        FilamentIcon::register([
            'panels::panel-switch-modern-icon' => 'tabler-switch-horizontal',
        ]);

        Modal::closedByClickingAway(false);

        PanelSwitch::configureUsing(function (PanelSwitch $panelSwitch) {
            $panelSwitch
                ->canSwitchPanels(true)
                ->visible(true)
                ->modalHeading('Available Panels')
                ->slideOver()
                ->modalWidth('sm')
                ->labels([
                    'admin' => 'Zeus',
                    'guests' => __('Showcase'),
                ])
                ->icons([
                    'admin' => 'heroicon-o-bolt',
                    'guests' => 'tabler-artboard-filled',
                ])
                ->iconSize(20)
                ->renderHook('panels::user-menu.before');

        });

        // $this->hooksRenderer();

        Filament::serving(function () {
            FilamentAsset::register([
                Css::make('flags', asset('css/flag-icons.css')),
                // Css::make('filament-stylesheet', asset('css/filament-zeus.css')),
            ]);
        });

        FilamentColor::register([
            ...collect(Color::all())->forget(['slate', 'gray', 'zinc', 'neutral', 'stone'])->toArray(),
            'primary' => Color::hex('#45B39D'),
            'secondary' => Color::hex('#F1948A'),
            'gray' => Color::Stone,
            'danger' => Color::Red,
            'info' => Color::Blue,
            'success' => Color::Green,
            'warning' => Color::Yellow,
        ]);

        // I know! 🤷🏽‍, please let me have my fun!!!
        /*Blade::directive('stillCode', function () {
            return '<span class="font-courier"><span class="font-courier rounded-lg bg-gray-200 italic px-2 dark:bg-gray-500"><span class="font-courier not-italic">Still ~ </span><span class="font-courier not-italic text-purple-500">&lt;?</span><span> code</span><span class="font-courier blink-cursor not-italic font-thin text-gray-400">|</span><span class="font-courier not-italic text-purple-500">?&gt;</span></span></span>';
        });*/

        Blade::directive('zeusz', function ($part = null) {
            return '<span class="title-font text-gray-700 group"><span class="title-font font-semibold text-primary-500 group-hover:text-secondary-500 transition ease-in-out duration-300">Lara&nbsp;<span class="title-font line-through italic text-secondary-500 group-hover:text-primary-500 transition ease-in-out duration-300">Z</span>eus</span></span>';
        });

        Blade::directive('stillStats', function ($code) {
            if (! app()->isLocal()) {
                return '<!-- stats --><script async defer data-website-id="' . $code . '" src="https://stats.still-code.com/script.js"></script>';
            }

            return '<!-- no tags for you -->';
        });

        $this->bootRoute();
    }

    /*public function hooksRenderer(): void
    {
        $hooks = [
            'zeus-forms.before',
            'zeus-forms.after',
            'zeus-form.before',
            'zeus-form.after',
            'zeus-form-section.before',
            // 'zeus-form-section.after',
            // 'zeus-form-field.before',
            // 'zeus-form-field.after',
        ];
        foreach ($hooks as $key => $hook) {
            FilamentView::registerRenderHook(
                "$hook",
                fn (): View => view(
                    'filament.hooks.' . session('current_theme', 'zeus') . '-placeholder',
                    ['data' => "$hook"]
                ),
            );
        }
    }*/

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function bootRoute()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });



    }
}
