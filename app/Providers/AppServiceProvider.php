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
            Filament::registerTheme(mix('css/app.css'));
        });

        Filament::registerRenderHook(
            'zeus-forms.before',
            fn (): View => view('filament.hooks.placeholder', ['data' => 'zeus-forms.before']),
        );
        Filament::registerRenderHook(
            'zeus-forms.after',
            fn (): View => view('filament.hooks.placeholder', ['data' => 'zeus-forms.after']),
        );

        Filament::registerRenderHook(
            'zeus-form.before',
            fn (): View => view('filament.hooks.placeholder', ['data' => 'zeus-form.before']),
        );
        Filament::registerRenderHook(
            'zeus-form.after',
            fn (): View => view('filament.hooks.placeholder', ['data' => 'zeus-form.after']),
        );

        /*Filament::registerRenderHook(
            'zeus-form-section.before',
            fn (): View => view('filament.hooks.placeholder', ['data'=>'zeus-form-section.before']),
        );
        Filament::registerRenderHook(
            'zeus-form-section.after',
            fn (): View => view('filament.hooks.placeholder', ['data'=>'zeus-form-section.after']),
        );*/

        /*Filament::registerRenderHook(
            'zeus-form-field.before',
            fn (): View => view('filament.hooks.placeholder', ['data'=>'zeus-form-field.before']),
        );
        Filament::registerRenderHook(
            'zeus-form-field.after',
            fn (): View => view('filament.hooks.placeholder', ['data'=>'zeus-form-field.after']),
        );*/

        Filament::registerRenderHook(
            'content.start',
            fn (): View => view('filament.hooks.db-notice'),
        );

        Filament::registerRenderHook(
            'global-search.end',
            fn (): View => view('filament.hooks.lang-switcher'),
        );

        Filament::registerRenderHook(
            'footer.after',
            fn (): View => view('filament.hooks.footer'),
        );

        Filament::registerNavigationGroups([
            'App',
            'Wind',
            'Sky',
            'Bolt',
            'Thunder',
            'Rain',
            'Rhea',
        ]);
    }
}
