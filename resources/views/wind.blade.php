<div class="px-4 py-4 bg-gradient-to-br from-white to-gray-50 shadow-lg rounded-3xl hover:shadow-xl transition ease-in-out duration-300 col-span-2 flex flex-col gap-2 items-center sm:items-start">
    <div class="mt-1 text-5xl sm:text-5xl lg:text-6xl font-extrabold">
        <span class="flex sm:flex-none mt-4 sm:mt-8 justify-center sm:justify-start">
            <x-ri-windy-line class="h-10 w-10 text-secondary-600 sm:-mt-4"/>
            {{--<x-iconpark-wind class="h-10 w-10 text-secondary-600 sm:-mt-4"/>--}}
            <span class="text-primary-600">Wind</span>
        </span>
    </div>
    <p class="my-10 text-gray-700 text-xl">
        Lara-zeus Wind, is a package provides a simple contact form manger, with the abilety to store the messages in the database, and you can reply to them from the dashboard.
    </p>
    <div class="mt-5 sm:flex sm:justify-center lg:justify-end w-full">
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
    </div>
</div>
