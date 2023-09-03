<x-item>
    @slot('title')
        @svg($package['icon'],'h-10 w-10 text-secondary-500 sm:-mt-4')
        <span class="text-primary-500">{{ $package['name'] }}</span>
    @endslot
    @slot('desc')
        {{ $package['desc'] }}
    @endslot
    @slot('btns')
        <a href="{{ $package['admin_url'] }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-secondary-500 hover:bg-secondary-500 px-4 py-2 dark:bg-secondary-600 dark:hover:bg-secondary-800">
            {{ __('Admin Panel') }}
        </a>

        @if($package['fe_url'] !== null)
            <a href="{{ $package['fe_url'] }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-primary-500 hover:bg-primary-700 px-4 py-2">
                {{ $package['fe_text'] }}
            </a>
        @endif
    @endslot
</x-item>
