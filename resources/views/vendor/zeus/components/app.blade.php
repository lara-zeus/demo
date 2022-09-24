<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('filament::layout.direction') ?? 'ltr' }}" class="antialiased filament js-focus-visible">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name', 'Laravel') }}">

    <!-- Seo Tags -->
    <x-seo::meta/>
    <!-- Seo Tags -->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=KoHo:ital,wght@0,200;0,300;0,500;0,700;1,200;1,300;1,600;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('vendor/zeus/frontend.css') }}">
    @livewireStyles
    @stack('styles')

    <style>
        * {font-family: 'KoHo', 'Almarai', sans-serif;}
        [x-cloak] {display: none !important;}
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:text-gray-100 dark:bg-gray-900 @if(app()->isLocal()) debug-screens @endif">

<header x-data="{ open: false }" class="bg-white dark:bg-black px-4">
    <nav class="container mx-auto">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a class="italic flex gap-2 group" href="{{ url('/') }}">
                        <img class="w-7" src="https://larazeus.com/images/zeus-logo.png" alt="{{ config('zeus.wind.name', config('app.name', 'Laravel')) }}">
                        @zeus
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                </div>

            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                <a href="{{ url('/blog') }}" class="whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-200 hover:text-secondary-600 dark:hover:text-secondary-300">
                    Blog
                </a>
                <a href="{{ url('/contact-us') }}" class="whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-200 hover:text-secondary-600 dark:hover:text-secondary-300">
                    Contact us
                </a>
                <a href="{{ url('/bolt') }}" class="whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-200 hover:text-secondary-600 dark:hover:text-secondary-300">
                    Forms
                </a>
                <a href="{{ url('/thunder') }}" class="whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-200 hover:text-secondary-600 dark:hover:text-secondary-300">
                    Tickets
                </a>
                <a href="{{ url('/admin') }}" class="whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-200 hover:text-secondary-600 dark:hover:text-secondary-300">
                    Admin Panel
                </a>
                <x-lang-switcher/>

                <div class=""
                    x-data="{
                        mode: null,

                        theme: null,

                        init: function () {
                            this.theme = localStorage.getItem('theme') || (this.isSystemDark() ? 'dark' : 'light')
                            this.mode = localStorage.getItem('theme') ? 'manual' : 'auto'

                            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (event) => {
                                if (this.mode === 'manual') return

                                if (event.matches && (! document.documentElement.classList.contains('dark'))) {
                                    this.theme = 'dark'

                                    document.documentElement.classList.add('dark')
                                } else if ((! event.matches) && document.documentElement.classList.contains('dark')) {
                                    this.theme = 'light'

                                    document.documentElement.classList.remove('dark')
                                }
                            })

                            $watch('theme', () => {
                                if (this.mode === 'auto') return

                                localStorage.setItem('theme', this.theme)

                                if (this.theme === 'dark' && (! document.documentElement.classList.contains('dark'))) {
                                    document.documentElement.classList.add('dark')
                                } else if (this.theme === 'light' && document.documentElement.classList.contains('dark')) {
                                    document.documentElement.classList.remove('dark')
                                }

                                $dispatch('dark-mode-toggled', this.theme)
                            })
                        },

                        isSystemDark: function () {
                            return window.matchMedia('(prefers-color-scheme: dark)').matches
                        },
                    }">
                    <span x-cloak x-show="theme === 'dark'" x-on:click="mode = 'manual'; theme = 'light'" class="cursor-pointer">
                        <x-heroicon-s-moon class="h-8 w-8 text-secondary-600 sm:-mt-4"/>
                    </span>
                    <span x-cloak x-show="theme === 'light'" x-on:click="mode = 'manual'; theme = 'dark'" class="cursor-pointer">
                        <x-heroicon-s-sun class="h-8 w-8 text-secondary-600 sm:-mt-4"/>
                    </span>
                </div>
            </div>
        </div>
    </nav>
</header>

@if(isset($header) || isset($breadcrumps))
    <header class="bg-gray-100 dark:bg-gray-800">
        <div class="container mx-auto py-2 px-3">

            @if(isset($breadcrumps))
                <nav class="text-gray-400 font-bold my-1" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        {{--<li class="flex items-center">
                            <a href="{{ route('blogs') }}">Home</a>
                            <x-iconpark-rightsmall-o class="fill-current w-4 h-4 mx-3" />
                        </li>--}}
                        {{ $breadcrumps }}
                    </ol>
                </nav>
            @endif

            @if(isset($header))
                <div class="italic font-semibold text-xl text-gray-600 dark:text-gray-100">
                    {{ $header }}
                </div>
            @endif
        </div>
    </header>
@endif

<div class="container mx-auto py-10">
    {{ $slot }}
</div>

<footer class="bg-gray-100 dark:bg-gray-800 p-6 mt-20 text-center font-light">
    <a href="https://larazeus.com" target="_blank">
        a gift with ❤️ &nbsp;from @zeus
    </a>
</footer>

<script src="{{ asset('vendor/zeus/app.js') }}" defer></script>

@stack('scripts')
@livewireScripts
@livewire('notifications')

<script>
    const theme = localStorage.getItem('theme')

    if ((theme === 'dark') || (! theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    }
</script>

</body>
</html>
