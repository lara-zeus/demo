<x-item>
    @slot('title')
        <x-ri-windy-line class="h-10 w-10 text-secondary-600 sm:-mt-4"/>
        <span class="text-primary-600">Wind</span>
    @endslot
    @slot('desc')
        @zeus Wind, is a package provides a simple contact form manger, with the ability to store the messages in the database, and you can reply to them from the dashboard.
    @endslot
    @slot('btns')
        <a href="{{ url('/admin/departments') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-secondary-500 hover:bg-secondary-600 px-4 py-2 dark:bg-secondary-700 dark:hover:bg-secondary-800">
            Admin Panel
        </a>

        <a href="{{ url('/contact-us') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 px-4 py-2">
            Contact Form
        </a>
    @endslot
</x-item>
