@php
    use Filament\Support\Enums\MaxWidth;

    $navigation = filament()->getNavigation();
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    <div class="fi-layout flex min-h-screen w-full overflow-x-clip">
        @if (filament()->hasNavigation())
            <div
                x-cloak
                x-data="{}"
                x-on:click="$store.sidebar.close()"
                x-show="$store.sidebar.isOpen"
                x-transition.opacity.300ms
                class="fi-sidebar-close-overlay fixed inset-0 z-30 bg-gray-950/50 transition duration-500 lg:hidden dark:bg-gray-950/75"
            ></div>

            <x-filament-panels::sidebar :navigation="$navigation" />
        @endif

        <div
            @if (filament()->isSidebarCollapsibleOnDesktop())
                x-data="{}"
                x-bind:class="{
                    'fi-main-ctn-sidebar-open': $store.sidebar.isOpen,
                }"
                x-bind:style="'display: flex; opacity:1;'" {{-- Mimics `x-cloak`, as using `x-cloak` causes visual issues with chart widgets --}}
            @elseif (filament()->isSidebarFullyCollapsibleOnDesktop())
                x-data="{}"
                x-bind:class="{
                    'fi-main-ctn-sidebar-open': $store.sidebar.isOpen,
                }"
                x-bind:style="'display: flex; opacity:1;'" {{-- Mimics `x-cloak`, as using `x-cloak` causes visual issues with chart widgets --}}
            @elseif (! (filament()->isSidebarCollapsibleOnDesktop() || filament()->isSidebarFullyCollapsibleOnDesktop() || filament()->hasTopNavigation() || (! filament()->hasNavigation())))
                x-data="{}"
                x-bind:style="'display: flex; opacity:1;'" {{-- Mimics `x-cloak`, as using `x-cloak` causes visual issues with chart widgets --}}
            @endif
            @class([
                'fi-main-ctn w-screen flex-1 flex-col',
                'h-full opacity-0 transition-all' => filament()->isSidebarCollapsibleOnDesktop() || filament()->isSidebarFullyCollapsibleOnDesktop(),
                'opacity-0' => ! (filament()->isSidebarCollapsibleOnDesktop() || filament()->isSidebarFullyCollapsibleOnDesktop() || filament()->hasTopNavigation() || (! filament()->hasNavigation())),
                'flex' => filament()->hasTopNavigation() || (! filament()->hasNavigation()),
            ])
        >
            @if (filament()->hasTopbar())
                {{ \Filament\Support\Facades\FilamentView::renderHook('panels::topbar.before') }}

                <x-filament-panels::topbar :navigation="$navigation" />

                {{ \Filament\Support\Facades\FilamentView::renderHook('panels::topbar.after') }}
            @endif
                <div class="min-h-full">
                    <div class="{{--bg-primary-100/50--}}
                    bg-gradient-to-tr from-secondary-50 to-primary-50 via-secondary-50
                    dark:from-secondary-600/30 dark:to-primary-600/30 dark:via-gray-600/30
                    {{--dark:bg-gradient-to-tr dark:from-secondary-900 dark:to-primary-900 dark:via-secondary-900--}}
                     pb-32">
                        <header class="py-14">
                            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                                <div class="" id="newHeader"></div>
                            </div>
                        </header>
                    </div>

                    <div class="-mt-32">
                        <div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
                            <div class="rounded-xl bg-gray-50/80 dark:bg-gray-900/80 ring-1 ring-gray-50 dark:ring-gray-950 px-5 py-6 shadow-xl sm:px-6">
                                <main
                                    @class([
                                        'fi-main mx-auto h-full w-full px-4 md:px-6 lg:px-8',
                                        match ($maxContentWidth ??= (filament()->getMaxContentWidth() ?? MaxWidth::SevenExtraLarge)) {
                                            MaxWidth::ExtraSmall, 'xs' => 'max-w-xs',
                                            MaxWidth::Small, 'sm' => 'max-w-sm',
                                            MaxWidth::Medium, 'md' => 'max-w-md',
                                            MaxWidth::Large, 'lg' => 'max-w-lg',
                                            MaxWidth::ExtraLarge, 'xl' => 'max-w-xl',
                                            MaxWidth::TwoExtraLarge, '2xl' => 'max-w-2xl',
                                            MaxWidth::ThreeExtraLarge, '3xl' => 'max-w-3xl',
                                            MaxWidth::FourExtraLarge, '4xl' => 'max-w-4xl',
                                            MaxWidth::FiveExtraLarge, '5xl' => 'max-w-5xl',
                                            MaxWidth::SixExtraLarge, '6xl' => 'max-w-6xl',
                                            MaxWidth::SevenExtraLarge, '7xl' => 'max-w-7xl',
                                            MaxWidth::Full, 'full' => 'max-w-full',
                                            MaxWidth::MinContent, 'min' => 'max-w-min',
                                            MaxWidth::MaxContent, 'max' => 'max-w-max',
                                            MaxWidth::FitContent, 'fit' => 'max-w-fit',
                                            MaxWidth::Prose, 'prose' => 'max-w-prose',
                                            MaxWidth::ScreenSmall, 'screen-sm' => 'max-w-screen-sm',
                                            MaxWidth::ScreenMedium, 'screen-md' => 'max-w-screen-md',
                                            MaxWidth::ScreenLarge, 'screen-lg' => 'max-w-screen-lg',
                                            MaxWidth::ScreenExtraLarge, 'screen-xl' => 'max-w-screen-xl',
                                            MaxWidth::ScreenTwoExtraLarge, 'screen-2xl' => 'max-w-screen-2xl',
                                            default => $maxContentWidth,
                                        },
                                    ])
                                >
                                    {{ \Filament\Support\Facades\FilamentView::renderHook('panels::content.start') }}

                                    {{ $slot }}

                                    {{ \Filament\Support\Facades\FilamentView::renderHook('panels::content.end') }}
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
            {{ \Filament\Support\Facades\FilamentView::renderHook('panels::footer') }}
        </div>
    </div>
</x-filament-panels::layout.base>
