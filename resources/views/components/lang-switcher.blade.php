<div class="relative">
    <x-filament::dropdown placement="bottom-start" teleport="true">
        <x-slot name="trigger">
            @svg('ri-translate', 'h-6 w-6 md:h-8 md:w-8 text-secondary-500 hover:text-primary-600 transition-all ease-in-out duration-300')
        </x-slot>

        <x-filament::dropdown.header class="dark:text-gray-200 text-gray-700"
            :color="'primary'"
            :icon="'ri-translate'"
            :href="'#'"
            :tag="'a'"
        >
            {{ __('Select Language') }}
        </x-filament::dropdown.header>

        <x-filament::dropdown.list>
            <div class="overflow-y-scroll max-h-56">
                @foreach(config('app.locales') as $local => $localInfo)
                    <x-filament::dropdown.list.item
                        class="font-semibold dark:text-green-200 text-green-700"
                            :color="(session('current_lang') === $local) ? 'primary' : 'green'"
                            :icon="'iconpark-dot'"
                            :href="url('lang/'.$local)"
                            tag="a"
                    >
                        <span class="flag-icons flag-icons-{{ $localInfo['flag'] }}"></span>
                        {{ str($localInfo['native'])->title() }}
                    </x-filament::dropdown.list.item>
                @endforeach
            </div>
        </x-filament::dropdown.list>
    </x-filament::dropdown>
</div>
