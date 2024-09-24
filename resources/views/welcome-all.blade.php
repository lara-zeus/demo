<x-app>
    <x-banner/>

    <div class="absolute flex justify-start items-center gap-4 top-16 ltr:right-4 rtl:left-4">
        <x-lang-switcher/>
        <x-dark-mode/>
        <x-theme-switcher/>
        <a href="https://github.com/lara-zeus" class="font-semibold leading-6" target="_blank" rel="noreferrer">
            @svg('tabler-brand-github-filled','h-8 w-8 text-secondary-500 hover:text-primary-500 transition-all ease-in-out duration-300')
        </a>
    </div>
    <div class="absolute top-16 ltr:left-4 rtl:right-4">
        <a href="https://larazeus.com" class="flex justify-end items-center gap-4">
            <img class="h-10 w-auto mx-auto" src="{{ asset('images/zeus-logo.png') }}" alt="Lara-zeus packages">
            <p class="text-2xl title-font">@zeusz</p>
        </a>
    </div>

    <div class="mt-32 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-3 gap-4 mx-4">
        @foreach(\App\Models\Package::get() as $package)
            @include('items.zeus')
        @endforeach
    </div>

    <div class="sm:my-32 my-10 mx-8 group">
        <div class="flex items-center justify-start gap-2">
            <a href="https://larazeus.com/"
               class="text-gray-700 dark:text-gray-100 text-lg transition ease-in-out underline decoration-wavy underline-offset-4 decoration-primary-500 hover:decoration-secondary-500">
                {{ __('Back To Site') }} @zeusz
            </a>
        </div>
    </div>
</x-app>
