@php
    use Filament\Support\Enums\IconPosition;
@endphp

@props([
    'active' => false,
    'alpineActive' => null,
    'badge' => null,
    'badgeColor' => null,
    'href' => null,
    'icon' => null,
    'iconColor' => 'gray',
    'iconPosition' => IconPosition::Before,
    'tag' => 'button',
    'target' => null,
    'type' => 'button',
])

@php
    $hasAlpineActiveClasses = filled($alpineActive);

    $inactiveItemClasses = 'hover:bg-gray-50 focus:bg-gray-50 dark:hover:bg-white/5 dark:focus:bg-white/5';

    $activeItemClasses = 'fi-active fi-tabs-item-active bg-gray-50 dark:bg-white/5';

    $inactiveLabelClasses = 'text-gray-500 group-hover:text-gray-700 group-focus:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-200 dark:group-focus:text-gray-200';

    $activeLabelClasses = 'text-custom-600 dark:text-custom-400';

    $iconClasses = 'fi-tabs-item-icon h-5 w-5 transition duration-75';

    $inactiveIconClasses = 'text-gray-400 dark:text-gray-500';

    $activeIconClasses = 'text-custom-600 dark:text-custom-400';
@endphp

<{{ $tag }}
    @if ($tag === 'button')
        type="{{ $type }}"
    @elseif ($tag === 'a')
        {{ \Filament\Support\generate_href_html($href, $target === '_blank') }}
    @endif
    @if ($hasAlpineActiveClasses)
        x-bind:class="{
            @js($inactiveItemClasses): ! {{ $alpineActive }},
            @js($activeItemClasses): {{ $alpineActive }},
        }"
    @endif
    {{
        $attributes
            ->merge([
                'aria-selected' => $active,
                'role' => 'tab',
            ])
            ->class([
                'fi-tabs-item group flex items-center gap-x-2 rounded-lg px-3 py-2 text-sm font-medium outline-none transition duration-75',
                $inactiveItemClasses => (! $hasAlpineActiveClasses) && (! $active),
                $activeItemClasses => (! $hasAlpineActiveClasses) && $active,
            ])
    }}
>
    @if ($icon && in_array($iconPosition, [IconPosition::Before, 'before']))
        <x-filament::icon
            :icon="$icon"
            :x-bind:class="$hasAlpineActiveClasses ? '{ ' . \Illuminate\Support\Js::from($inactiveIconClasses) . ': ! (' . $alpineActive . '), ' . \Illuminate\Support\Js::from($activeIconClasses) . ': ' . $alpineActive . ' }' : null"
            @class([
                $iconClasses,
                $inactiveIconClasses => (! $hasAlpineActiveClasses) && (! $active),
                $activeIconClasses => (! $hasAlpineActiveClasses) && $active,
            ])
        />
    @endif

    <span
        @if ($hasAlpineActiveClasses)
            x-bind:class="{
                @js($inactiveLabelClasses): ! {{ $alpineActive }},
                @js($activeLabelClasses): {{ $alpineActive }},
            }"
        @endif
        @class([
            'fi-tabs-item-label transition duration-75',
            $inactiveLabelClasses => (! $hasAlpineActiveClasses) && (! $active),
            $activeLabelClasses => (! $hasAlpineActiveClasses) && $active,
        ])
    >
        {{ $slot }}
    </span>

    @if ($icon && in_array($iconPosition, [IconPosition::After, 'after']))
        <x-filament::icon
            :icon="$icon"
            :x-bind:class="$hasAlpineActiveClasses ? '{ ' . \Illuminate\Support\Js::from($inactiveIconClasses) . ': ! (' . $alpineActive . '), ' . \Illuminate\Support\Js::from($activeIconClasses) . ': ' . $alpineActive . ' }' : null"
            @class([
                $iconClasses,
                $inactiveIconClasses => (! $hasAlpineActiveClasses) && (! $active),
                $activeIconClasses => (! $hasAlpineActiveClasses) && $active,
            ])
        />
    @endif

    @if (filled($badge))
        <x-filament::badge :color="$badgeColor" size="sm">
            {{ $badge }}
        </x-filament::badge>
    @endif
</{{ $tag }}>
