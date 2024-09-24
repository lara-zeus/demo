<x-filament-panels::page>
    <x-guests.package-card
        name="preset color picker"
        vendor="awcodes"
        github="palette"
        filament="https://filamentphp.com/plugins/awcodes-palette"
        image="https://camo.githubusercontent.com/f9276643b55da160de01664e6077c1e48811a6b29336ba2651d4fa77594a9108/68747470733a2f2f7265732e636c6f7564696e6172792e636f6d2f61772d636f6465732f696d6167652f75706c6f61642f76313732353033393334382f706c7567696e732f70616c657474652f6177636f6465732d70616c657474652e6a7067"
    >
        <x-slot name="description">
            A color picker field for Filament Forms that uses preset color palettes.
        </x-slot>
    </x-guests.package-card>

    {{ $this->form }}
</x-filament-panels::page>
