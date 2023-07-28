<?php

namespace App\Providers\Filament;

use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Contracts\View\View;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use LaraZeus\Bolt\BoltPlugin;
use LaraZeus\Rain\RainPlugin;
use LaraZeus\Rhea\RheaPlugin;
use LaraZeus\Sky\SkyPlugin;
use LaraZeus\Thunder\ThunderPlugin;
use LaraZeus\Wind\WindPlugin;
use RyanChandler\FilamentNavigation\FilamentNavigationPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->font('Karla', provider: GoogleFontProvider::class)
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'gray' => Color::Stone,
                'primary' => Color::Lime,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->plugins([
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(['en', 'ar', 'fr']),
                WindPlugin::make(),
                SkyPlugin::make(),
                BoltPlugin::make(),
                ThunderPlugin::make(),
                RainPlugin::make(),
                RheaPlugin::make(),
                FilamentNavigationPlugin::make(),
            ])
            ->navigationGroups([
                'App',
                'Wind',
                'Sky',
                'Bolt',
                'Thunder',
                'Rain',
                'Rhea',
            ])
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
            ->renderHook(
                'global-search.end',
                fn(): View => view('filament.hooks.lang-switcher'),
            )
            ->renderHook(
                'footer.after',
                fn(): View => view('filament.hooks.footer'),
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->pages([
                Pages\Dashboard::class,
            ])
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
