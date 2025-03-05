<x-filament-panels::page>
    <x-guests.package-card
            name="Mason"
            vendor="awcodes"
            github="mason"
            filament="https://filamentphp.com/plugins/awcodes-mason"
            image="https://camo.githubusercontent.com/5f5f34968b5168ef5b96d8839881b58040574e76439dcedb3c914c2ea55d1ef7/68747470733a2f2f7265732e636c6f7564696e6172792e636f6d2f61772d636f6465732f696d6167652f75706c6f61642f775f313230302c665f6175746f2c715f6175746f2f706c7567696e732f6d61736f6e2f6177636f6465732d6d61736f6e2e6a7067"
    >
        <x-slot name="description">
            A simple block based drag and drop page / document builder field for Filament.
        </x-slot>
    </x-guests.package-card>

    <form wire:submit.prevent="store">
        {{ $this->form }}

        <div class="my-10 text-center">
            <x-filament::button
                form="store"
                type="submit"
            >
                Save
            </x-filament::button>
        </div>

    </form>
    <x-filament-actions::modals />



    <div class="prose mx-auto my-32 p-10">
        <h3 class="my-4">Rendered Content:</h3>
        <div>
            {!! mason($post->content, \App\Mason\BrickCollection::make())->toHtml() !!}
        </div>
    </div>


</x-filament-panels::page>
