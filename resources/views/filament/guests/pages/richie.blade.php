<x-filament-panels::page>
    <x-guests.package-card
            name="Richie"
            vendor="awcodes"
            github="richie"
            filament="https://filamentphp.com/plugins/awcodes-richie"
    >
        <x-slot name="description">
            Richie is just another rich text editor for Filament PHP.
        </x-slot>
    </x-guests.package-card>

    <form>
        {{ $this->form }}
    </form>
    <x-filament-actions::modals />
</x-filament-panels::page>
