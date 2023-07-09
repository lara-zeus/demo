<div class="relative">
    <x-filament::dropdown placement="bottom-start" teleport="true">
        <x-slot name="trigger">
            <x-ri-translate class="h-6 w-6 md:h-8 md:w-8 text-secondary-500 hover:text-primary-600 transition-all ease-in-out duration-300" />
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
            @foreach(config('app.locales') as $local => $localInfo)
                <x-filament::dropdown.list.item class="dark:text-gray-200 text-gray-700"
                    :color="(session('current_lang') === $local) ? 'warning' : 'secondary'"
                    :icon="'iconpark-dot'"
                    :href="url('lang/'.$local)"
                    tag="a"
                >
                    {{  $localInfo['native'] }}
                </x-filament::dropdown.list.item>
            @endforeach
        </x-filament::dropdown.list>
    </x-filament::dropdown>
</div>
