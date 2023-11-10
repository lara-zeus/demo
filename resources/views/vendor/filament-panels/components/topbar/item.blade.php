@props([
    'active' => false,
    'activeIcon' => null,
    'badge' => null,
    'badgeColor' => null,
    'icon' => null,
    'shouldOpenUrlInNewTab' => false,
    'url' => null,
])

@php
    $tag = $url ? 'a' : 'button';
@endphp

<li
    @class([
        'fi-topbar-item overflow-hidden',
        'fi-topbar-item-active' => $active,
    ])
>
    <{{ $tag }}
        @if ($url)
            {{ \Filament\Support\generate_href_html($url, $shouldOpenUrlInNewTab) }}
        @else
            type="button"
        @endif
        @class([
            'flex items-center justify-center gap-x-2 rounded-lg px-3 py-2 text-sm font-semibold outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5',
            'text-gray-700 dark:text-gray-200' => ! $active,
            'bg-gray-50 text-custom-600 dark:bg-white/5 dark:text-custom-400' => $active,
        ])
    >
        @if ($icon || $activeIcon)
            <x-filament::icon
                :icon="($active && $activeIcon) ? $activeIcon : $icon"
                @class([
                    'fi-topbar-item-icon h-5 w-5',
                    'text-gray-400 dark:text-gray-500' => ! $active,
                    'text-custom-500' => $active,
                ])
            />
        @endif

        <span>
            {{ $slot }}
        </span>

        @if (filled($badge))
            <x-filament::badge :color="$badgeColor" size="sm">
                {{ $badge }}
            </x-filament::badge>
        @endif

        @if (! $url)
            <x-filament::icon
                icon="heroicon-m-chevron-down"
                icon-alias="panels::topbar.group.toggle-button"
                @class([
                    'fi-topbar-group-toggle-icon h-5 w-5',
                    'text-gray-400 dark:text-gray-500' => ! $active,
                    'text-custom-500' => $active,
                ])
            />
        @endif
    </{{ $tag }}>
</li>
