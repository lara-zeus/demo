<x-filament-widgets::widget>
    <x-filament::section
        icon="tabler-artboard-filled"
        icon-color="secondary"
        icon-size="lg"
    >
        <x-slot name="heading">
            Plugins Showcase
        </x-slot>

        Check out our filamentPHP
        <x-filament::link
            tooltip="3 plugins available"
            badge-color="secondary"
            :href="url('guests')"
        >
            Community Plugins Showcase
            <x-slot name="badge">
                3
            </x-slot>
        </x-filament::link>
    </x-filament::section>
</x-filament-widgets::widget>
