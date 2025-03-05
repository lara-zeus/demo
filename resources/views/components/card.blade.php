@props([
    'color' => null,
    'heading' => null,
    'headingColor' => null,
    'footer' => null,
    'footerColor' => null,
    'cap' => null,
    'flush' => false,
])

<div
        {{ $attributes->class([
            'group relative flex flex-col overflow-hidden border border-gray-300',
            '[&:has([data-card-link])]:cursor-pointer',
        ]) }}
        x-data="{}"
        x-on:click="
        ($event) => {
            if ($el.querySelector('[data-card-link]')) {
                window.location = $el
                    .querySelector('[data-card-link]')
                    .getAttribute('href')
            }
        }
    "
>
    @if ($cap)
        <div class="overflow-hidden relative">
            {{ $cap }}
        </div>
    @endif

    @if ($heading)
        <h3
                @class([
                    'text-lg text-center font-bold font-display py-2 px-4 border-b',
                    match ($headingColor) {
                        'primary' => 'border-primary-500 bg-primary-500 text-white',
                        'secondary' => 'border-secondary-500 bg-secondary-500 text-white',
                        'tertiary' => 'border-tertiary-500 bg-tertiary-500 text-tertiary-900',
                        'accent' => 'border-accent-500 bg-accent-500 text-white',
                        'info' => 'border-info-300 bg-info-300 text-info-900',
                        'success' => 'border-success-300 bg-success-300 text-success-900',
                        'warning' => 'border-warning-300 bg-warning-300 text-warning-900',
                        'danger' => 'border-danger-300 bg-danger-300 text-danger-900',
                        default => 'border-gray-300 bg-gray-100 text-gray-900',
                    },
                ])
        >
            {{ $heading }}
        </h3>
    @endif

    <div
            @class([
                'flex-1 p-4' => ! $flush,
                match ($color) {
                    'primary' => 'bg-primary-50',
                    'secondary' => 'bg-secondary-50',
                    'tertiary' => 'bg-tertiary-50',
                    'accent' => 'bg-accent-50',
                    'gray' => 'bg-gray-50',
                    'info' => 'bg-info-50',
                    'success' => 'bg-success-50',
                    'warning' => 'bg-warning-50',
                    'danger' => 'bg-danger-50',
                    default => 'bg-white',
                },
            ])
    >
        {{ $slot }}
    </div>

    @if ($footer)
        <div
                @class([
                    'border-t px-4 py-3',
                    match ($footerColor) {
                        'primary' => 'bg-primary-100 border-primary-300 text-primary-900',
                        'secondary' => 'bg-secondary-100 border-secondary-300 text-secondary-900',
                        'tertiary' => 'bg-tertiary-100 border-tertiary-300 text-tertiary-900',
                        'accent' => 'bg-accent-100 border-accent-300 text-accent-900',
                        'info' => 'bg-info-100 border-info-300 text-info-900',
                        'success' => 'bg-success-100 border-success-300 text-success-900',
                        'warning' => 'bg-warning-100 border-warning-300 text-warning-900',
                        'danger' => 'bg-danger-100 border-danger-300 text-danger-900',
                        default => 'border-gray-300 bg-gray-100 text-gray-900',
                    },
                ])
        >
            {{ $footer }}
        </div>
    @endif
</div>