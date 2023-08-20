<x-item>
    @slot('title')
        @svg('ri-windy-line','h-10 w-10 text-secondary-500 sm:-mt-4')
        <span class="text-primary-500">Wind</span>
    @endslot
    @slot('desc')
        {{ app()->getLocale() }}
        {{ __('Wind, is a package provides a simple contact form manger, with the ability to store the messages in the database, and you can reply to them from the dashboard') }}.
    @endslot
    @slot('btns')
        <a href="{{ url('/admin/departments') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-secondary-500 hover:bg-secondary-500 px-4 py-2 dark:bg-secondary-600 dark:hover:bg-secondary-800">
            {{ __('Admin Panel') }}
        </a>

        <a href="{{ route('contact') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-primary-500 hover:bg-primary-700 px-4 py-2">
            {{ __('Contact Form') }}
        </a>
    @endslot
</x-item>
