<x-filament-widgets::widget>
    <x-filament::section
        icon="tabler-artboard-filled"
        icon-color="secondary"
        :compact="true"
    >
        <x-slot name="heading">
            Plugins Showcase
        </x-slot>

        Check out our filamentPHP
        <x-filament::link
            tooltip="{{ count(\Filament\Facades\Filament::getPanel('guests')->getPages()) - 1 }} plugins available"
            badge-color="secondary"
            :href="url('guests')"
        >
            Community Plugins Showcase
            <x-slot name="badge">
                {{ count(\Filament\Facades\Filament::getPanel('guests')->getPages()) - 1 }}
            </x-slot>
        </x-filament::link>
    </x-filament::section>
</x-filament-widgets::widget>
