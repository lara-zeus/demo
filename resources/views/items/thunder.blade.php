<x-item>
    @slot('title')
        @svg('ri-thunderstorms-line','h-10 w-10 text-secondary-500 sm:-mt-4')
        <span class="text-primary-500">Thunder</span>
    @endslot
    @slot('desc')
        {{ __('Thunder is a tickets system for laravel built as filament plugin') }}.
    @endslot
    @slot('btns')
        <a href="{{ url('/admin/offices') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-secondary-500 hover:bg-secondary-500 px-4 py-2 dark:bg-secondary-600 dark:hover:bg-secondary-800">
            {{ __('Admin Panel') }}
        </a>
        <a href="{{ route('thunder.offices.list') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-primary-500 hover:bg-primary-700 px-4 py-2">
            {{ __('Tickets') }}
        </a>
    @endslot
</x-item>
