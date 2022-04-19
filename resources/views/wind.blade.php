<x-item>
    @slot('title')
        <x-ri-windy-line class="h-10 w-10 text-secondary-600 sm:-mt-4"/>
        <span class="text-primary-600">Wind</span>
    @endslot
    @slot('desc')
        @zeus Wind, is a package provides a simple contact form manger, with the ability to store the messages in the database, and you can reply to them from the dashboard.
    @endslot
    @slot('btns')
        <div class="rounded-md shadow">
            <a href="{{ url('/admin') }}" target="_blank" class="transition ease-in-out w-full flex items-center justify-center px-8 py-3 text-base font-medium rounded-md text-white bg-secondary-500 hover:bg-secondary-600 px-4 py-2">
                Admin Panel
            </a>
        </div>
        <div class="mt-3 sm:mt-0 sm:ml-3">
            <a href="{{ url('/contact-us') }}" class="transition ease-in-out w-full flex items-center justify-center px-8 py-3 text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 px-4 py-2">
                Contact Form
            </a>
        </div>
    @endslot
</x-item>
