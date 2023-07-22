<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\View\View;
use LaraZeus\Bolt\BoltPlugin;
use LaraZeus\Rain\RainPlugin;
use LaraZeus\Rhea\RheaPlugin;
use LaraZeus\Sky\SkyPlugin;
use LaraZeus\Thunder\ThunderPlugin;
use LaraZeus\Wind\WindPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->navigationGroups([
                'App',
                'Wind',
                'Sky',
                'Bolt',
                'Thunder',
                'Rain',
                'Rhea',
            ])
            ->plugin(new WindPlugin())
            ->plugin(new SkyPlugin())
            ->plugin(new BoltPlugin())
            ->plugin(new RainPlugin())
            ->plugin(new RheaPlugin())
            ->plugin(new ThunderPlugin())
            ->plugin(new SpatieLaravelTranslatablePlugin())

            ->renderHook(
                'zeus-forms.before',
                fn(): View => view('filament.hooks.placeholder', ['data' => 'zeus-forms.before']),
            )
            ->renderHook(
                'zeus-forms.after',
                fn(): View => view('filament.hooks.placeholder', ['data' => 'zeus-forms.after']),
            )
            ->renderHook(
                'zeus-form.before',
                fn(): View => view('filament.hooks.placeholder', ['data' => 'zeus-form.before']),
            )
            ->renderHook(
                'zeus-form.after',
                fn(): View => view('filament.hooks.placeholder', ['data' => 'zeus-form.after']),
            )

            ->renderHook(
                'content.start',
                fn(): View => view('filament.hooks.db-notice'),
            )
            // todo
            /*->renderHook(
                'global-search.end',
                fn(): View => view('filament.hooks.lang-switcher'),
            )*/
            ->renderHook(
                'footer.after',
                fn(): View => view('filament.hooks.footer'),
            )
           // ->theme(asset('css/app.css'))
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
