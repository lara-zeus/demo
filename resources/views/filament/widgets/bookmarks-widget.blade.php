<x-filament-widgets::widget>
    <x-filament::section
        icon-color="danger"
        icon="heroicon-m-bookmark-square"
        heading="You Bookmarks" :compact="true">
        {{ $this->bookmarkInfolist }}
    </x-filament::section>
</x-filament-widgets::widget>
