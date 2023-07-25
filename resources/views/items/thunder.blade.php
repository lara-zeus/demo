<x-item>
    @slot('title')
        @svg('ri-thunderstorms-line','h-10 w-10 text-secondary-600 sm:-mt-4')
        <span class="text-primary-600">Thunder</span>
    @endslot
    @slot('desc')
        @zeus Thunder is a tickets system for laravel built as filament plugin.
    @endslot
    @slot('btns')
        <a href="{{ url('/admin/offices') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-secondary-500 hover:bg-secondary-600 px-4 py-2 dark:bg-secondary-700 dark:hover:bg-secondary-800">
            {{ __('Admin Panel') }}
        </a>
        <a href="{{ route('thunder.offices.list') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 px-4 py-2">
            Tickets
        </a>
    @endslot
</x-item>
