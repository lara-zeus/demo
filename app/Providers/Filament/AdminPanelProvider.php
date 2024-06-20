<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use Awcodes\FilamentQuickCreate\QuickCreatePlugin;
use Awcodes\FilamentVersions\VersionsPlugin;
use Awcodes\FilamentVersions\VersionsWidget;
use Awcodes\LightSwitch\LightSwitchPlugin;
use Awcodes\Overlook\OverlookPlugin;
use Awcodes\Overlook\Widgets\OverlookWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
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
use LaraZeus\Boredom\BoringAvatarPlugin;
use LaraZeus\Boredom\BoringAvatarsProvider;
use LaraZeus\DynamicDashboard\DynamicDashboardPlugin;
use LaraZeus\Rhea\RheaPlugin;
use LaraZeus\Sky\SkyPlugin;
use LaraZeus\Wind\Filament\Resources\LetterResource;
use LaraZeus\Wind\WindPlugin;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;

class AdminPanelProvider extends PanelProvider
{
    /**
     * @throws \Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->theme(asset('css/filament-zeus.css'))
            ->defaultAvatarProvider(
                BoringAvatarsProvider::class
            )
            ->databaseNotifications()
            ->homeUrl('/')
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->profile(isSimple: false)
            ->font('Karla')
            ->plugins($this->getPlugins())
            ->brandLogo(fn () => view('filament.logo'))
            ->colors([
                ...collect(Color::all())->forget(['slate', 'gray', 'zinc', 'neutral', 'stone'])->toArray(),
                'primary' => Color::hex('#45B39D'),
                'secondary' => Color::hex('#F1948A'),
                'gray' => Color::Stone,
                'danger' => Color::Red,
                'info' => Color::Blue,
                'success' => Color::Green,
                'warning' => Color::Yellow,
            ])

            //->topNavigation()

            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth('full')
            ->favicon(asset('favicon.ico'))
            ->navigationGroups([
                NavigationGroup::make()->label('App')
                    ->icon('tabler-brand-appgallery'),
                NavigationGroup::make()
                    ->icon('akar-thunder')
                    ->label('Bolt'),
                NavigationGroup::make()
                    ->icon('vaadin-bolt')
                    ->label('Thunder')
                    ->extraTopbarAttributes(['class' => 'fi-sidebar-group-paid'])
                    ->extraSidebarAttributes(['class' => 'fi-sidebar-group-paid']),
                NavigationGroup::make()
                    ->icon('rpg-feather-wing')
                    ->label('Hermes')
                    ->extraTopbarAttributes(['class' => 'fi-sidebar-group-paid'])
                    ->extraSidebarAttributes(['class' => 'fi-sidebar-group-paid']),
                NavigationGroup::make()
                    ->icon('clarity-crown-solid')
                    ->label('Helen')
                    ->extraTopbarAttributes(['class' => 'fi-sidebar-group-paid'])
                    ->extraSidebarAttributes(['class' => 'fi-sidebar-group-paid']),
                NavigationGroup::make()
                    ->icon('rpg-chain')
                    ->label('Hera')
                    ->extraTopbarAttributes(['class' => 'fi-sidebar-group-paid'])
                    ->extraSidebarAttributes(['class' => 'fi-sidebar-group-paid']),
                NavigationGroup::make()
                    ->icon('tabler-calendar-heart')
                    ->label('Athena')
                    ->extraTopbarAttributes(['class' => 'fi-sidebar-group-paid'])
                    ->extraSidebarAttributes(['class' => 'fi-sidebar-group-paid']),

                NavigationGroup::make()->label('Sky')
                    ->icon('ri-cloud-windy-line'),
                NavigationGroup::make()->label('Wind')
                    ->icon('ri-windy-line'),
                NavigationGroup::make()->label('Dynamic Dashboard')
                    ->icon('carbon-rain-heavy'),
                NavigationGroup::make()->label('Rhea')
                    ->icon('tabler-bow'),
            ])
            // lang
            ->renderHook(
                'panels::user-menu.profile.after',
                fn (): View => view('filament.hooks.lang-switcher'),
            )
            // footer
            ->renderHook(
                'panels::footer',
                fn (): View => view('filament.hooks.footer'),
            )
            //
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            //
            ->pages([
                Pages\Dashboard::class,
                //\LaraZeus\DynamicDashboard\Filament\Pages\DynamicDashboard::class,
            ])
            ->widgets([
                //UmamiWidgetStatsGrouped::class,
                //UmamiWidgetTableReferrers::class,
                //UmamiWidgetTableUrls::class,

                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
                VersionsWidget::class,
                OverlookWidget::class,
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

    public function getPlugins(): array
    {
        return [
            \Schmeits\FilamentUmami\FilamentUmamiPlugin::make(),
            BoringAvatarPlugin::make(),
            FilamentBackgroundsPlugin::make(),
            SpotlightPlugin::make(),
            LightSwitchPlugin::make(),
            OverlookPlugin::make()
                ->sort(5)
                ->excludes([
                    LetterResource::class,
                ])
                ->alphabetical(),
            VersionsPlugin::make()
                ->widgetSort(4)
                ->widgetColumnSpan('full')
                ->items([
                    new MyCustomVersionProvider(),
                ]),
            QuickCreatePlugin::make()
                ->sortBy('navigation')
                ->excludes([
                    LetterResource::class,
                ]),
            SpatieLaravelTranslatablePlugin::make()
                ->defaultLocales(['en', 'pt', 'ko']),

            //ChronosPlugin::make(),
            WindPlugin::make(),
            SkyPlugin::make(),
            BoltPlugin::make(),
            DynamicDashboardPlugin::make(),
            RheaPlugin::make(),
        ];
    }
}
