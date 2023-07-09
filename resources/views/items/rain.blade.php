<x-item>
    @slot('title')
        <x-carbon-rain-heavy class="h-10 w-10 text-secondary-600 sm:-mt-4"/>
        <span class="text-primary-600">Rain</span>
    @endslot
    @slot('desc')
        @zeus Rain, simple way to manage widgets for your website landing page
    @endslot
    @slot('btns')
        <a href="{{ url('/admin/layouts') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-secondary-500 hover:bg-secondary-600 px-4 py-2 dark:bg-secondary-700 dark:hover:bg-secondary-800">
            {{ __('Admin Panel') }}
        </a>

        <a href="{{ route('landing-page') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 px-4 py-2">
            home page
        </a>
    @endslot
</x-item>
