@props([
    'bgColor' => 'white',
])

<div
        @class([
            'branded @container',
            match ($bgColor) {
                'primary' => 'bg-primary-300 text-white',
                'secondary' => 'bg-secondary-300 text-white',
                'tertiary' => 'bg-tertiary-300 text-white',
                'accent' => 'bg-accent-300 text-gray-900',
                'gray' => 'bg-gray-100 text-gray-900',
                'white' => 'bg-white text-gray-900',
                default => $bgColor,
            },
        ])
>
    {{ $slot }}
</div>