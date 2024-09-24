<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
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
use LaraZeus\Boredom\BoringAvatarPlugin;
use LaraZeus\Boredom\BoringAvatarsProvider;
use LaraZeus\Boredom\Enums\Variants;

class GuestsPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('guests')
            ->path('guests')
            ->brandName('Plugins Showcase')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->defaultAvatarProvider(
                BoringAvatarsProvider::class
            )
            ->viteTheme('resources/css/filament/guests/theme.css')
            ->renderHook(
                'panels::footer',
                fn (): View => view('filament.hooks.footer-guests'),
            )
            ->discoverResources(in: app_path('Filament/Guests/Resources'), for: 'App\\Filament\\Guests\\Resources')
            ->discoverPages(in: app_path('Filament/Guests/Pages'), for: 'App\\Filament\\Guests\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Guests/Widgets'), for: 'App\\Filament\\Guests\\Widgets')
            ->widgets([
                //Widgets\FilamentInfoWidget::class,
            ])
            ->plugins([
                BoringAvatarPlugin::make()
                //  ->colors(['0A0310','49007E','FF005B','FF7D10','FFB238'])
                //  ->square()
                //  ->variant(Variants::MARBLE)
                ,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                //AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ]);
    }
}
