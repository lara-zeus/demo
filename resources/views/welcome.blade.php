<x-app>
    <div class="relative inline-flex top-0 rtl:right-0 ltr:left-0">
        <x-lang-switcher/>
    </div>
    <div class="text-center p-10">
        <img class="h-32 w-auto mx-auto" src="https://larazeus.com/images/zeus-logo.png" alt="Lara-zeus Wind package">
        <p class="text-6xl">@zeus</p>
        <p class="text-xl my-4">Demo App for all @zeus packages</p>

        <span class="mb-4 flex items-center justify-center gap-2 text-xl">
            <span>built as</span>
                <a class="text-secondary-600 flex items-center justify-center gap-2 underline underline-offset-2 decoration-primary-600 hover:decoration-secondary-500 transition ease-in-out" href="https://filamentphp.com/plugins/wind" target="_blank">
                   filament plugin
                    <img src="https://filamentphp.com/images/dog.svg" alt="Dog" class="h-10 object-center">
                </a>
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 mx-4">
        @include('wind')
        @include('sky')
        @include('bolt')
        @include('soon')
    </div>

    <div class="sm:my-32 my-10 mx-8 group">
        <div class="flex items-center justify-start gap-2" >
            <x-iconoir-left-round-arrow class="w-8 h-8 text-yellow-600"/>
            <a href="https://larazeus.com/" class="text-gray-600 underline underline-offset-2 transition ease-in-out decoration-primary-600 hover:decoration-secondary-500">Back To @zeus Site</a>
        </div>
    </div>
</x-app>
