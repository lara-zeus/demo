@props([
    'alpineValid' => null,
    'valid' => true,
])

@php
    $hasAlpineValidClasses = filled($alpineValid);

    $validInputClasses = 'text-custom-600 ring-gray-950/10 focus:ring-custom-600 checked:focus:ring-custom-500/50 dark:ring-white/20 dark:checked:bg-custom-500 dark:focus:ring-custom-500 dark:checked:focus:ring-custom-400/50 dark:disabled:ring-white/10';
    $invalidInputClasses = 'text-danger-600 ring-danger-600 focus:ring-danger-600 checked:focus:ring-danger-500/50 dark:ring-danger-500 dark:checked:bg-danger-500 dark:focus:ring-danger-500 dark:checked:focus:ring-danger-400/50';
@endphp

<input
    type="checkbox"
    @if ($hasAlpineValidClasses)
        x-bind:class="{
            @js($validInputClasses): {{ $alpineValid }},
            @js($invalidInputClasses): {{ "(! {$alpineValid})" }},
        }"
    @endif
    {{
        $attributes
            ->class([
                'fi-checkbox-input rounded border-none bg-white shadow-sm ring-1 transition duration-75 checked:ring-0 focus:ring-2 focus:ring-offset-0 disabled:pointer-events-none disabled:bg-gray-50 disabled:text-gray-50 disabled:checked:bg-current disabled:checked:text-gray-400 dark:bg-white/5 dark:disabled:bg-transparent dark:disabled:checked:bg-gray-600',
                $validInputClasses => (! $hasAlpineValidClasses) && $valid,
                $invalidInputClasses => (! $hasAlpineValidClasses) && (! $valid),
            ])
    }}
/>
