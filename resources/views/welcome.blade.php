<x-app>
    <div  class="absolute flex justify-start items-center gap-4 top-4 ltr:right-4 rtl:left-4">
        <x-lang-switcher/>
        <x-dark-mode/>

    </div>

    <div class="text-center py-6 dark:text-gray-100">
        <img class="h-32 w-auto mx-auto" src="https://larazeus.com/images/zeus-logo.png" alt="Lara-zeus packages">
        <p class="text-6xl">@zeus</p>
        <p class="text-xl my-4 title-font">Demo app for all @zeus packages</p>
        <span class="title-font mb-4 flex items-center justify-center gap-2 text-xl">
            <span>built as</span>
                <a class="text-secondary-600 dark:text-secondary-100 flex items-center justify-center gap-2 underline decoration-wavy underline-offset-4 decoration-primary-600 hover:decoration-secondary-500 transition ease-in-out" href="https://filamentphp.com/plugins" target="_blank">
                   filament plugin
                    <img src="https://filamentphp.com/images/dog.svg" alt="Dog" class="h-10 object-center">
                </a>
        </span>
    </div>

    <div class="title-font grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 gap-4 mx-4">
        @include('items.wind')
        @include('items.sky')
        @include('items.bolt')
        @include('items.rain')
        @include('items.thunder')
        @include('items.soon')
    </div>

    <div class="sm:my-32 my-10 mx-8 group">
        <div class="flex items-center justify-start gap-2">
            <x-iconoir-left-round-arrow class="rtl:hidden w-9 h-9 text-secondary-600"/>
            <x-iconoir-right-round-arrow class="ltr:hidden w-9 h-9 text-secondary-600"/>
            <a href="https://larazeus.com/" class="text-gray-700 dark:text-gray-100 text-lg transition ease-in-out underline decoration-wavy underline-offset-4 decoration-primary-600 hover:decoration-secondary-500">Back To @zeus Site</a>
        </div>
    </div>
</x-app>
