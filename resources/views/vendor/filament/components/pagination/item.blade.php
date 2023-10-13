@props([
    'active' => false,
    'disabled' => false,
    'icon' => null,
    'iconAlias' => null,
    'label' => null,
    'separator' => false,
])

@php
    $hasIcon = filled($icon);
    $hasLabel = filled($label) || $separator;
    $isDisabled = $disabled || $separator;
@endphp

<li
    {{
        $attributes->class([
            'fi-pagination-item overflow-hidden border-x-[0.5px] border-gray-200 first:rounded-s-lg first:border-s-0 last:rounded-e-lg last:border-e-0 dark:border-white/10',
            'focus-within:z-10 focus-within:ring-2 focus-within:ring-custom-600 dark:focus-within:ring-custom-500' => ! $isDisabled,
        ])
    }}
>
    <button
        @disabled($isDisabled)
        type="button"
        @class([
            'relative overflow-hidden p-2 text-sm font-semibold outline-none transition duration-75',
            'text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400' => $hasIcon,
            'text-gray-700 dark:text-gray-200' => $hasLabel && (! ($active || $isDisabled)),
            'hover:bg-gray-50 dark:hover:bg-white/5' => ! $isDisabled,
            'bg-gray-50 text-custom-600 dark:bg-white/5 dark:text-custom-400' => $active,
            'cursor-default' => $separator,
        ])
    >
        @if ($hasIcon)
            <x-filament::icon
                :alias="$iconAlias"
                :icon="$icon"
                class="fi-pagination-item-icon h-5 w-5"
            />
        @endif

        @if ($hasLabel)
            <span class="px-1.5">
                {{ $label ?? '...' }}
            </span>
        @endif
    </button>
</li>
