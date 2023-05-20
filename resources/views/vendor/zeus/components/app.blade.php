<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('filament::layout.direction') ?? 'ltr' }}"
      class="antialiased filament js-focus-visible">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name', 'Laravel') }}">

    <!-- Seo Tags -->
    <x-seo::meta/>
    <!-- Seo Tags -->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=KoHo:ital,wght@0,200;0,300;0,500;0,700;1,200;1,300;1,600;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('vendor/zeus/frontend.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles
    @stack('styles')

    <style>
        * {
            font-family: 'KoHo', 'Almarai', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>
<body
    class="font-sans antialiased bg-gray-50 text-gray-900 dark:text-gray-100 dark:bg-gray-900 @if(app()->isLocal()) debug-screens @endif">

<header x-data="{ open: false }" class="bg-white dark:bg-black py-4">
    <nav class="container mx-auto">
        <div class="flex justify-between px-2">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <img class="w-7" src="https://larazeus.com/images/zeus-logo.png"
                     alt="{{ config('zeus.wind.name', config('app.name', 'Laravel')) }}">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">@zeus</span>
            </a>
            <div class="hidden sm:flex gap-4">
                <x-dropdown>
                    <x-slot name="oppener">
                        {{ __('Site') }}
                    </x-slot>
                    <ul class="px-2 py-1 overflow-hidden">
                        <a href="{{ url('/blog') }}"
                           class="flex my-2 whitespace-nowrap transition ease-in-out">
                            {{ __('Blog') }}
                        </a>
                        <a href="{{ url('/faq') }}"
                           class="flex my-2 whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-400 hover:text-secondary-600 dark:hover:text-secondary-300">
                            {{ __('Faq') }}
                        </a>
                        <a href="{{ url('/library') }}"
                           class="flex my-2 whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-400 hover:text-secondary-600 dark:hover:text-secondary-300">
                            {{ __('Library') }}
                        </a>
                        <a href="{{ url('/contact-us') }}"
                           class="flex my-2 whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-400 hover:text-secondary-600 dark:hover:text-secondary-300">
                            {{ __('Contact us') }}
                        </a>
                    </ul>
                </x-dropdown>

                <x-dropdown>
                    <x-slot name="oppener">
                        <div class="flex-shrink-0 flex">
                            {{ __('Forms') }}
                        </div>
                    </x-slot>
                    <ul class="px-2 py-1 overflow-hidden">
                        <a href="{{ url('/bolt') }}"
                           class="flex my-2 whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-400 hover:text-secondary-600 dark:hover:text-secondary-300">
                            {{ __('All Forms') }}
                        </a>
                        <a href="{{ url('/bolt/entries') }}"
                           class="flex my-2 whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-400 hover:text-secondary-600 dark:hover:text-secondary-300">
                            {{ __('My Entries') }}
                        </a>
                    </ul>
                </x-dropdown>

                <x-dropdown>
                    <x-slot name="oppener">
                        <div class="flex-shrink-0 flex">
                            {{ __('Tickets') }}
                        </div>
                    </x-slot>
                    <ul class="px-2 py-1 overflow-hidden">
                        <a href="{{ url('/thunder') }}"
                           class="flex my-2 whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-400 hover:text-secondary-600 dark:hover:text-secondary-300">
                            {{ __('All Tickets') }}
                        </a>
                        <a href="{{ url('/thunder/tickets') }}"
                           class="flex my-2 whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-400 hover:text-secondary-600 dark:hover:text-secondary-300">
                            {{ __('My Tickets') }}
                        </a>
                    </ul>
                </x-dropdown>

                <a href="{{ url('/admin') }}"
                   class="whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-400 hover:text-secondary-600 dark:hover:text-secondary-300">
                    {{ __('Admin Panel') }}
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
                    <span x-cloak x-show="theme === 'dark'" x-on:click="mode = 'manual'; theme = 'light'"
                          class="cursor-pointer">
                        <x-heroicon-s-moon class="w-4 h-4 md:w-6 md:h-6 text-secondary-600"/>
                    </span>
                    <span x-cloak x-show="theme === 'light'" x-on:click="mode = 'manual'; theme = 'dark'"
                          class="cursor-pointer">
                        <x-heroicon-s-sun class="w-4 h-4 md:w-6 md:h-6 text-secondary-600"/>
                    </span>
                </div>
            </div>
            <button @click="open = !open" type="button"
                    class="inline-flex sm:hidden items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500"
                    aria-controls="mobile-menu" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg :class="{ 'hidden': open, 'block': !(open) }" class="h-6 w-6"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-cloak :class="{ 'block': open, 'hidden': !(open) }" class="h-6 w-6"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div x-show="open" @click.away="open = false" x-cloak class="" id="mobile-menu"
             x-transition:enter="duration-200 ease-out"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="duration-100 ease-in"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
        >
            <div class="mt-0 rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white dark:bg-gray-800 divide-y-2 divide-gray-50 mx-2">
                <div class="flex flex-col p-4 gap-4">
                    <a href="{{ url('/blog') }}"
                       class="whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-200 hover:text-secondary-600 dark:hover:text-secondary-300">
                        Blog
                    </a>
                    <a href="{{ url('/contact-us') }}"
                       class="whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-200 hover:text-secondary-600 dark:hover:text-secondary-300">
                        Contact us
                    </a>
                    <x-filament-support::hr/>
                    <a href="{{ url('/bolt') }}"
                       class="whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-200 hover:text-secondary-600 dark:hover:text-secondary-300">
                        All Forms
                    </a>
                    <a href="{{ url('/bolt/entries') }}"
                       class="whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-200 hover:text-secondary-600 dark:hover:text-secondary-300">
                        My Entries
                    </a>
                    <x-filament-support::hr/>
                    <a href="{{ url('/thunder') }}"
                       class="whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-200 hover:text-secondary-600 dark:hover:text-secondary-300">
                        All Tickets
                    </a>
                    <a href="{{ url('/thunder/tickets') }}"
                       class="whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-200 hover:text-secondary-600 dark:hover:text-secondary-300">
                        My Tickets
                    </a>
                    <x-filament-support::hr/>
                    <a href="{{ url('/admin') }}"
                       class="whitespace-nowrap transition ease-in-out text-primary-600 dark:text-primary-200 hover:text-secondary-600 dark:hover:text-secondary-300">
                        Admin Panel
                    </a>

                    <div class="flex gap-4 mt-4">
                        <x-lang-switcher/>

                        <span x-data="{
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
                        <span x-cloak x-show="theme === 'dark'" x-on:click="mode = 'manual'; theme = 'light'" class="cursor-pointer inline-flex">
                            <x-heroicon-s-moon class="w-4 h-4 md:w-6 md:h-6 text-secondary-600"/>
                        </span>
                        <span x-cloak x-show="theme === 'light'" x-on:click="mode = 'manual'; theme = 'dark'" class="cursor-pointer inline-flex">
                            <x-heroicon-s-sun class="w-4 h-4 md:w-6 md:h-6 text-secondary-600"/>
                        </span>
                    </span>
                    </div>

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

    if ((theme === 'dark') || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    }
</script>

</body>
</html>
