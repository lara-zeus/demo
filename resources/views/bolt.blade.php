<div class="flex flex-col sm:flex-row w-full gap-4">
    <img class="h-32 w-auto mx-auto" src="{{ asset('vendor/zeus/images/zeus-logo.png') }}" alt="Lara-zeus Bolt package">
    <div class="flex flex-col gap-2 items-center sm:items-start flex-grow">
        <div class="mt-1 text-5xl sm:text-5xl lg:text-6xl font-extrabold {{--flex flex-row sm:items-center sm:justify-start--}}">
            <span class="mr-4">@zeus</span>
            <span class="flex sm:flex-none mt-4 sm:mt-8 justify-center sm:justify-start">
                        <x-clarity-bolt-line class="h-8 w-8 text-secondary-600 sm:-mt-4"/>
                        <span class="text-gray-600">Bolt</span>
                    </span>
        </div>
        <p class="mt-3 text-gray-700 text-2xl flex flex-col">
        <div class="mb-4 flex items-center justify-start gap-2">
            <span>built as</span>
            <span>
                            <a class="text-secondary-600 flex items-center justify-center gap-2 underline underline-offset-2 decoration-primary-600 hover:decoration-secondary-500 transition ease-in-out" href="https://filamentphp.com/plugins/bolt" target="_blank">
                               filament plugin
                                <img src="https://filamentphp.com/images/dog.svg" alt="Dog" class="h-10 object-center">
                            </a>
                        </span>
        </div>
        <span class="text-lg">
                        Lara-zeus Bolt, is a package provides form manager.
                    </span>
        </p>

        <div class="mt-5 sm:flex sm:justify-center lg:justify-start w-full">
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

        <div class="mt-10 group">
            <a class="flex items-center justify-start gap-2" href="https://larazeus.com/">
                <x-iconpark-arrowcircleleft class="w-4 h-4 text-yellow-500"/>
                <span class="underline underline-offset-2 transition ease-in-out decoration-primary-600 hover:decoration-secondary-500">Back To @zeus Site</span>
            </a>
        </div>

    </div>
</div>
