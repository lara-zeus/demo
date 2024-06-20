<x-filament-panels::page>

    <x-guests.package-card
        name="Shout"
        vendor="awcodes"
        github="shout"
        filament="https://filamentphp.com/plugins/awcodes-shout"
        image="https://filamentphp.com/images/content/plugins/images/awcodes-shout.webp"
    >
        <x-slot name="description">
            A simple inline contextual notice for Filament Forms, basically just a fancy placeholder.
        </x-slot>
    </x-guests.package-card>

    {{ $this->form }}
</x-filament-panels::page>
