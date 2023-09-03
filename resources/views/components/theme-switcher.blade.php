<div class="relative">
    <x-filament::dropdown maxHeight="250px" placement="bottom-start" teleport="true">
        <x-slot name="trigger">
            @svg('bi-brush','h-6 w-6 text-secondary-500 hover:text-primary-500 transition-all ease-in-out duration-300')
        </x-slot>

        <x-filament::dropdown.header class="font-semibold"
            :color="'gray'"
            :icon="'ri-translate'"
            :href="'#'"
            :tag="'a'"
        >
            {{ __('Select Theme') }}
        </x-filament::dropdown.header>

        <x-filament::dropdown.list>
            @foreach(array_keys(config('zeus.themes')) as $theme)
                <x-filament::dropdown.list.item
                    class="font-semibold"
                    color="text-primary-500"
                        :icon="($theme === 'zeus') ? 'rpg-lightning-bolt' : 'rpg-daisy'"
                        :href="url('theme/'.$theme)"
                        tag="a">
                    <div class="flex gap-2">
                        {{ str($theme)->title() }}
                    </div>
                </x-filament::dropdown.list.item>
            @endforeach
        </x-filament::dropdown.list>
    </x-filament::dropdown>
</div>
