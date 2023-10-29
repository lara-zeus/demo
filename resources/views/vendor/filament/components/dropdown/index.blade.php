@props([
    'maxHeight' => null,
    'offset' => 8,
    'placement' => null,
    'shift' => false,
    'teleport' => false,
    'trigger' => null,
    'width' => null,
])

<div
    x-data="{
        toggle: function (event) {
            $refs.panel.toggle(event)
        },

        open: function (event) {
            $refs.panel.open(event)
        },

        close: function (event) {
            $refs.panel.close(event)
        },
    }"
    {{ $attributes->class(['fi-dropdown']) }}
>
    <div
        x-on:click="toggle"
        {{ $trigger->attributes->class(['fi-dropdown-trigger flex cursor-pointer']) }}
    >
        {{ $trigger }}
    </div>

    <div
        x-cloak
        x-float{{ $placement ? ".placement.{$placement}" : '' }}.flip{{ $shift ? '.shift' : '' }}{{ $teleport ? '.teleport' : '' }}{{ $offset ? '.offset' : '' }}="{ offset: {{ $offset }} }"
        x-ref="panel"
        x-transition:enter-start="opacity-0"
        x-transition:leave-end="opacity-0"
        @if ($attributes->has('wire:key'))
            wire:ignore.self
            wire:key="{{ $attributes->get('wire:key') }}.panel"
        @endif
        @class([
            'fi-dropdown-panel absolute z-10 w-screen divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-gray-950/5 transition dark:divide-white/5 dark:bg-gray-900 dark:ring-white/10',
            match ($width) {
                'xs' => 'max-w-xs',
                'sm' => 'max-w-sm',
                'md' => 'max-w-md',
                'lg' => 'max-w-lg',
                'xl' => 'max-w-xl',
                '2xl' => 'max-w-2xl',
                '3xl' => 'max-w-3xl',
                '4xl' => 'max-w-4xl',
                '5xl' => 'max-w-5xl',
                '6xl' => 'max-w-6xl',
                '7xl' => 'max-w-7xl',
                null => 'max-w-[14rem]',
                default => $width,
            },
            'overflow-y-auto' => $maxHeight,
        ])
        @style([
            "max-height: {$maxHeight}" => $maxHeight,
        ])
    >
        {{ $slot }}
    </div>
</div>
