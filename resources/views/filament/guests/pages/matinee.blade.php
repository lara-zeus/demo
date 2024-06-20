<x-filament-panels::page>

    <x-guests.package-card
        name="Matinee"
        vendor="awcodes"
        github="matinee"
        filament="https://filamentphp.com/plugins/awcodes-matinee"
        image="https://filamentphp.com/images/content/plugins/images/awcodes-matinee.webp"
    >
        <x-slot name="description">
            OEmbed field for Filament Panel and Form Builders.
        </x-slot>
    </x-guests.package-card>

    {{ $this->form }}
</x-filament-panels::page>
