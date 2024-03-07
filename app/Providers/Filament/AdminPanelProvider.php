<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use Archilex\AdvancedTables\Enums\FavoritesBarTheme;
use Archilex\AdvancedTables\Plugin\AdvancedTablesPlugin;
use Archilex\AdvancedTables\Resources\UserViewResource;
use Awcodes\Curator\CuratorPlugin;
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
use LaraZeus\Athena\AthenaPlugin;
use LaraZeus\Athena\Extensions\Athena;
use LaraZeus\Athena\Filament\Pages\Calendar;
use LaraZeus\Athena\Filament\Resources\RequestResource;
use LaraZeus\Athena\Filament\Resources\ServiceResource;
use LaraZeus\Bolt\BoltPlugin;
use LaraZeus\Bolt\Filament\Resources\CategoryResource;
use LaraZeus\Bolt\Filament\Resources\CollectionResource;
use LaraZeus\Bolt\Filament\Resources\FormResource;
use LaraZeus\Boredom\BoringAvatarPlugin;
use LaraZeus\Boredom\BoringAvatarsProvider;
use LaraZeus\DynamicDashboard\DynamicDashboardPlugin;
use LaraZeus\Helen\Filament\Resources\LinksResource;
use LaraZeus\Helen\HelenPlugin;
use LaraZeus\Hera\Filament\Resources\SeoScanResource;
use LaraZeus\Hera\HeraPlugin;
use LaraZeus\Hermes\Filament\Resources\BranchResource;
use LaraZeus\Hermes\Filament\Resources\MenuItemLabelsResource;
use LaraZeus\Hermes\Filament\Resources\MenuResource;
use LaraZeus\Hermes\Filament\Resources\MenuSectionResource;
use LaraZeus\Hermes\HermesPlugin;
use LaraZeus\Rhea\RheaPlugin;
use LaraZeus\Sky\SkyPlugin;
use LaraZeus\Thunder\Extensions\Thunder;
use LaraZeus\Thunder\Filament\Resources\OfficeResource;
use LaraZeus\Thunder\Filament\Resources\TicketResource;
use LaraZeus\Thunder\ThunderPlugin;
use LaraZeus\Wind\Filament\Resources\LetterResource;
use LaraZeus\Wind\WindPlugin;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;
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
            ->brandLogo(fn() => view('filament.logo'))
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
            //->unsavedChangesAlerts()

            // hermes
            ->renderHook(
                'panels::page.start',
                fn(array $scopes): View => view('filament.hooks.hermes', ['scopes' => $scopes]),
                scopes: [
                    BranchResource::class,
                    MenuItemLabelsResource::class,
                    MenuResource::class,
                    MenuSectionResource::class,
                ],
            )

            // athena
            /*->renderHook(
                'panels::page.start',
                fn(array $scopes): View => view('filament.hooks.athena', ['scopes' => $scopes]),
                scopes: [
                    RequestResource::class,
                    ServiceResource::class,
                    Calendar::class,
                ],
            )*/
            ->renderHook(
                'panels::topbar.start',
                fn(array $scopes): View => view('filament.hooks.store'),
            )
            // thunder
            ->renderHook(
                'panels::page.start',
                fn(array $scopes): View => view('filament.hooks.thunder', ['scopes' => $scopes]),
                scopes: [
                    OfficeResource::class,
                    TicketResource::class,
                ],
            )
            // helen
            ->renderHook(
                'panels::page.start',
                fn(array $scopes): View => view('filament.hooks.helen', ['scopes' => $scopes]),
                scopes: [
                    LinksResource::class,
                ],
            )
            // hera
            ->renderHook(
                'panels::page.start',
                fn(array $scopes): View => view('filament.hooks.hera', ['scopes' => $scopes]),
                scopes: [
                    SeoScanResource::class,
                ],
            )
            // bolt
            ->renderHook(
                'panels::page.start',
                fn(array $scopes): View => view('filament.hooks.bolt', ['scopes' => $scopes]),
                scopes: [
                    FormResource::class,
                    CategoryResource::class,
                    CollectionResource::class,
                ],
            )
            //db notice
            /*->renderHook(
                'panels::content.start',
                fn (): View => view('filament.hooks.db-notice'),
            )*/
            // lang
            ->renderHook(
                'panels::user-menu.profile.after',
                fn(): View => view('filament.hooks.lang-switcher'),
            )
            // footer
            ->renderHook(
                'panels::footer',
                fn(): View => view('filament.hooks.footer'),
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
            BoringAvatarPlugin::make(),
            FilamentBackgroundsPlugin::make(),
            AdvancedTablesPlugin::make()
                ->resourceNavigationGroup('Bolt')
                ->resourceNavigationSort(99)
                ->favoritesBarTheme(FavoritesBarTheme::Filament),
            CuratorPlugin::make()
                ->label(fn(): string => __('Media'))
                ->pluralLabel(fn(): string => __('Media'))
                ->navigationIcon('heroicon-o-photo')
                ->navigationGroup(fn(): string => __('Hermes'))
                ->navigationSort(99)
                ->navigationCountBadge(),
            SpotlightPlugin::make(),
            LightSwitchPlugin::make(),
            OverlookPlugin::make()
                ->sort(5)
                ->excludes([
                    LetterResource::class,
                    TicketResource::class,
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
                    UserViewResource::class,
                    LetterResource::class,
                    TicketResource::class,
                    MenuSectionResource::class,
                    RequestResource::class,
                ]),

            SpatieLaravelTranslatablePlugin::make()
                ->defaultLocales(['en', 'pt', 'ko']),

            WindPlugin::make(),
            SkyPlugin::make(),
            HeraPlugin::make(),
            HelenPlugin::make()
                ->baseDomain('demo.larazeus.com')
                ->prefix('not-so-short'),

            FilamentFullCalendarPlugin::make()
                //     ->schedulerLicenseKey('')
                ->selectable()
                ->editable()
            //->timezone()
            //->locale()
            //->plugins()
            //->config()
            ,

            BoltPlugin::make()
                ->extensions([
                    Thunder::class,
                    Athena::class,
                ]),

            ThunderPlugin::make(),
            AthenaPlugin::make(),
            DynamicDashboardPlugin::make(),
            RheaPlugin::make(),
            HermesPlugin::make(),
        ];
    }
}
