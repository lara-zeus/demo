<x-app>
    <div class="absolute flex justify-start items-center gap-4 top-4 ltr:right-4 rtl:left-4">
        <x-lang-switcher/>
        <x-dark-mode/>
        <x-theme-switcher/>
        <a href="https://github.com/lara-zeus" class="font-semibold leading-6" target="_blank" rel="noreferrer">
            @svg('tabler-brand-github-filled','h-8 w-8 text-secondary-500 hover:text-primary-500 transition-all ease-in-out duration-300')
        </a>
    </div>

    <div class="text-center py-6 dark:text-gray-100">
        <img class="h-32 w-auto mx-auto" src="{{ asset('images/zeus-logo.png') }}" alt="Lara-zeus packages">
        <p class="text-6xl title-font">@zeusz</p>
        <p class="text-3xl my-4 font-[Kalam]">{{ __('Demo app for all') }} @zeusz {{ __('Packages') }}</p>
        <span class="font-[Kalam] font mb-4 flex items-center justify-center gap-2 text-4xl">
            <span>{{ __('built as') }}</span>
            <a class="text-secondary-500 dark:text-secondary-100 flex items-center justify-center gap-2 underline decoration-wavy underline-offset-4 decoration-primary-500 hover:decoration-secondary-500 transition ease-in-out"
               href="https://filamentphp.com/plugins" target="_blank">
               {{ __('filament plugin') }}
            </a>
        </span>
    </div>

    <div class="my-32 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-3 gap-4 mx-4">
        @foreach(\App\Models\Package::get() as $package)
            @include('items.'.session('current_theme','zeus'))
        @endforeach
        @include('items.soon')
    </div>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Kalam:wght@300&display=swap");
    </style>

    <div class="sm:my-32 my-10 mx-8 group">
        <div class="flex items-center justify-start gap-2">
            <a href="https://larazeus.com/"
               class="text-gray-700 dark:text-gray-100 text-lg transition ease-in-out underline decoration-wavy underline-offset-4 decoration-primary-500 hover:decoration-secondary-500">
                {{ __('Back To Site') }} @zeusz
            </a>
        </div>
    </div>
</x-app>
