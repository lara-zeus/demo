<x-filament-panels::page>

    <x-guests.package-card
            name="Table Repeater"
            vendor="awcodes"
            github="shout"
            filament="https://filamentphp.com/plugins/awcodes-table-repeater"
            image="https://filamentphp.com/images/content/plugins/images/awcodes-table-repeater.webp"
    >
        <x-slot name="description">
            A modified version of the Filament Forms Repeater to display it as a table.
        </x-slot>
    </x-guests.package-card>

    {{ $this->form }}
</x-filament-panels::page>
