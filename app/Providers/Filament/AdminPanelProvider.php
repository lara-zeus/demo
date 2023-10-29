<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use Awcodes\Curator\CuratorPlugin;
use Awcodes\FilamentGravatar\GravatarPlugin;
use Awcodes\FilamentGravatar\GravatarProvider;
use Awcodes\FilamentQuickCreate\QuickCreatePlugin;
use Awcodes\FilamentVersions\VersionsPlugin;
use Awcodes\FilamentVersions\VersionsWidget;
use Awcodes\LightSwitch\LightSwitchPlugin;
use Awcodes\Overlook\OverlookPlugin;
use Awcodes\Overlook\Widgets\OverlookWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
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
use LaraZeus\Bolt\Filament\Resources\CategoryResource;
use LaraZeus\Bolt\Filament\Resources\CollectionResource;
use LaraZeus\Bolt\Filament\Resources\FormResource;
use LaraZeus\Bolt\Filament\Resources\ResponseResource;
use LaraZeus\Hermes\Filament\Resources\BranchResource;
use LaraZeus\Hermes\Filament\Resources\MenuItemLabelsResource;
use LaraZeus\Hermes\Filament\Resources\MenuResource;
use LaraZeus\Hermes\Filament\Resources\MenuSectionResource;
use LaraZeus\Hermes\HermesPlugin;
use LaraZeus\Rain\RainPlugin;
use LaraZeus\Rhea\RheaPlugin;
use LaraZeus\Sky\SkyPlugin;
use LaraZeus\Thunder\Extensions\Thunder;
use LaraZeus\Thunder\Filament\Resources\OfficeResource;
use LaraZeus\Thunder\Filament\Resources\OperationsResource;
use LaraZeus\Thunder\Filament\Resources\TicketResource;
use LaraZeus\Thunder\ThunderPlugin;
use LaraZeus\Wind\Filament\Resources\LetterResource;
use LaraZeus\Wind\WindPlugin;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use RyanChandler\FilamentNavigation\FilamentNavigation;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->homeUrl('/')
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->profile()
            ->font('Karla')
            ->plugins($this->getPlugins())
            ->defaultAvatarProvider(GravatarProvider::class)

            ->brandLogo(fn () => view('filament.logo'))

            //->topNavigation()
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth('full')
            ->favicon(asset('favicon.ico'))
            ->navigationGroups([
                'App',
                'Wind',
                'Sky',
                'Bolt',
                'Thunder',
                'Rain',
                'Rhea',
            ])

            // hermes
            ->renderHook(
                'panels::page.start',
                fn (array $scopes): View => view('filament.hooks.hermes', ['scopes' => $scopes]),
                scopes: [
                    BranchResource::class,
                    MenuItemLabelsResource::class,
                    MenuResource::class,
                    MenuSectionResource::class,
                ],
            )
            // thunder
            ->renderHook(
                'panels::page.start',
                fn (array $scopes): View => view('filament.hooks.thunder', ['scopes' => $scopes]),
                scopes: [
                    OfficeResource::class,
                    OperationsResource::class,
                    TicketResource::class,
                ],
            )
            // bolt
            ->renderHook(
                'panels::page.start',
                fn (array $scopes): View => view('filament.hooks.bolt', ['scopes' => $scopes]),
                scopes: [
                    FormResource::class,
                    CategoryResource::class,
                    CollectionResource::class,
                    ResponseResource::class,
                ],
            )
            //db notice
            /*->renderHook(
                'panels::content.start',
                fn (): View => view('filament.hooks.db-notice'),
            )*/
            // lang
            ->renderHook(
                'panels::user-menu.before',
                fn (): View => view('filament.hooks.lang-switcher'),
            )
            // footer
            ->renderHook(
                'panels::footer',
                fn (): View => view('filament.hooks.footer'),
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
            CuratorPlugin::make()
                ->label(fn (): string => __('Media'))
                ->pluralLabel(fn (): string => __('Media'))
                ->navigationIcon('heroicon-o-photo')
                ->navigationGroup(fn (): string => __('Hermes'))
                ->navigationSort(99)
                ->navigationCountBadge(),

            GravatarPlugin::make(),
            SpotlightPlugin::make(),
            LightSwitchPlugin::make(),
            OverlookPlugin::make()
                ->sort(5)
                ->excludes([
                    ResponseResource::class,
                    LetterResource::class,
                    OperationsResource::class,
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
                ->excludes([
                    ResponseResource::class,
                    LetterResource::class,
                    OperationsResource::class,
                    TicketResource::class,
                ]),

            SpatieLaravelTranslatablePlugin::make()
                ->defaultLocales(['en', 'pt', 'ko']),

            FilamentNavigation::make(),

            WindPlugin::make(),
            SkyPlugin::make(),

            BoltPlugin::make()
                ->extensions([
                    Thunder::class,
                ]),

            ThunderPlugin::make(),
            RainPlugin::make(),
            RheaPlugin::make(),
            HermesPlugin::make(),
        ];
    }
}
