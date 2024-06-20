<x-filament-panels::page>

    <x-guests.package-card
            name="Badgeable Column"
            vendor="awcodes"
            github="shout"
            filament="https://filamentphp.com/plugins/awcodes-badgeable-column"
            image="https://filamentphp.com/images/content/plugins/images/awcodes-badgeable-column.webp"
    >
        <x-slot name="description">
            A custom table column that supports prefixed and suffixed badges on column content.
        </x-slot>
    </x-guests.package-card>

    {{ $this->table }}
</x-filament-panels::page>
