<x-filament-panels::page>

    <x-filament::section>
        <x-slot name="heading">
            Radio Deck Filament Plugin
        </x-slot>

        <x-slot name="description">
            Turn filament default radio button into a selectable card with icons, title and description.
        </x-slot>

        <x-filament::link href="https://filamentphp.com/plugins/jaocero-radio-deck">
            Radio Deck
        </x-filament::link>
        Plugin

        by
        <x-filament::link href="https://github.com/199ocero">
            Jay-Are Ocero
        </x-filament::link>

        <img alt="Radio Deck Filament Plugin" class="my-10 aspect-video mx-auto w-1/2" src="https://filamentphp.com/images/content/plugins/images/jaocero-radio-deck.webp"/>


    </x-filament::section>

    {{ $this->form }}
</x-filament-panels::page>
