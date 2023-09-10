<x-item-breeze>
    @slot('title')
        @svg($package['icon'],'h-10 w-10 text-secondary-500 dark:text-secondary-400 sm:-mt-4')
        <span class="text-primary-500 dark:text-primary-300">{{ $package['name'] }}</span>
    @endslot
    @slot('desc')
        {{ $package['desc'] }}
    @endslot
    @slot('btns')
        @if($package['admin_url'] !== null)
            <a href="{{ $package['admin_url'] }}" class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{ __('Admin Panel') }}
            </a>
        @endif

        @if($package['fe_url'] !== null)
            <a href="{{ $package['fe_url'] }}" class="cursor-pointer inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-100 tracking-widest transition ease-in-out duration-150">
                {{ $package['fe_text'] }}
            </a>
        @endif
    @endslot
</x-item-breeze>
