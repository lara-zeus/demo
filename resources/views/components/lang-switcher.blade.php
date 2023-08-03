<div class="relative">
    <x-filament::dropdown maxHeight="250px" placement="bottom-start" teleport="true">
        <x-slot name="trigger">
            @svg('ri-translate', 'h-6 w-6 md:h-8 md:w-8 text-secondary-500 hover:text-primary-500 transition-all ease-in-out duration-300')
        </x-slot>

        <x-filament::dropdown.header class="font-semibold"
            :color="'gray'"
            :icon="'ri-translate'"
            :href="'#'"
            :tag="'a'"
        >
            {{ __('Select Language') }}
        </x-filament::dropdown.header>

        <x-filament::dropdown.list>
            @foreach(config('app.locales') as $local => $localInfo)
                <x-filament::dropdown.list.item
                    class="font-semibold"
                        :color="(app()->getLocale() === $local) ? 'primary' : null"
                        :icon="'heroicon-m-chevron-right'"
                        :href="url('lang/'.$local)"
                        tag="a"
                >
                    <div class="flex gap-2">
                        <span class="flag-icons flag-icons-{{ $localInfo['flag'] }}"></span>
                        {{ str($localInfo['native'])->title() }}
                    </div>
                </x-filament::dropdown.list.item>
            @endforeach
        </x-filament::dropdown.list>
    </x-filament::dropdown>
</div>
