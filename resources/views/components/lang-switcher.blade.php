<x-dropdown>
    <x-slot name="oppener">
        <div class="block flex-shrink-0 w-10 h-10 rounded-full bg-gray-50 flex">
            <x-ri-translate class="w-8 h-8 mx-auto my-auto text-secondary-500" />
        </div>
    </x-slot>
    <ul class="py-1 space-y-1 overflow-hidden {{--bg-white shadow rounded-xl--}}">
        @foreach(config('app.locales') as $local)
            <x-filament::dropdown.item
                    :color="'secondary'"
                    :icon="'iconpark-dot'"
                    :href="url('lang/'.$local)"
                    tag="a"
            >
                {{ __($local) }}
            </x-filament::dropdown.item>
            {{--<a href="#" class="block w-full px-4 py-2 text-left text-sm hover:bg-gray-100 disabled:text-gray-500" >
                Add task above
            </a>--}}
        @endforeach
    </ul>
</x-dropdown>
