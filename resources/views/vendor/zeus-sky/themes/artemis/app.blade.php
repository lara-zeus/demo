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

    {{--<link rel="stylesheet" href="{{ asset('vendor/zeus/frontend.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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


@php $menu = RyanChandler\FilamentNavigation\Facades\FilamentNavigation::get('main-header-menu'); @endphp

<body class=" @if(app()->isLocal()) debug-screens @endif antialiased text-gray-800 dark:bg-black dark:text-gray-400">

<header class="container px-8 mx-auto xl:px-5  max-w-screen-lg py-5 lg:py-8">
    <nav>
        <div class="flex flex-wrap justify-between md:flex-nowrap md:gap-10">
            <div class="order-1 hidden w-full flex-col items-center justify-start md:order-none md:flex md:w-auto md:flex-1 md:flex-row md:justify-end">
                @foreach($menu->items as $item)
                    <a href="{{ $item['data']['url'] }}" class="px-5 py-2 text-sm font-medium text-gray-600 hover:text-blue-500 dark:text-gray-400">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
            <div class="flex w-full items-center justify-between md:w-auto">

                <a class="text-center" href="{{ url('/') }}">
                    <img class="w-7 mx-auto" src="https://larazeus.com/images/zeus-logo.png" alt="{{ config('zeus.wind.name', config('app.name', 'Laravel')) }}">
                    @zeus
                </a>

                <button aria-label="Toggle Menu"
                        class="ml-auto rounded-md px-2 py-1 text-gray-500 focus:text-blue-500 focus:outline-none dark:text-gray-300 md:hidden "
                        type="button" aria-expanded="false"
                        data-headlessui-state="">
                    <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                              d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                    </svg>
                </button>
            </div>
            <div
                class="order-2 hidden w-full flex-col items-center justify-start md:order-none md:flex md:w-auto md:flex-1 md:flex-row">
                @foreach($menu->items as $item)
                    <a href="{{ $item['data']['url'] }}" class="px-5 py-2 text-sm font-medium text-gray-600 hover:text-blue-500 dark:text-gray-400">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </nav>
</header>

<div class="container mx-auto">
    {{ $slot }}
</div>

<footer class="container px-8 mx-auto xl:px-5  max-w-screen-lg py-5 lg:py-8 mt-10 border-t border-gray-100 dark:border-gray-800">
    <div class="text-center text-sm">Copyright © 2023 Stablo. All rights reserved.</div>
    <div class="mt-1 flex justify-center gap-1 text-center text-sm text-gray-500 dark:text-gray-600">
        <span>
            Made by
            <a href="https://web3templates.com/?ref=stablo-template" target="_blank">Web3Templates</a>
        </span>

        <span>·</span>

        <span>
            <a href="https://github.com/web3templates/stablo">Github</a>
        </span>
    </div>
    <div class="mt-2 flex items-center justify-between">
        <div class="mt-5">
            <a href="https://vercel.com/?utm_source=web3templates&amp;utm_campaign=oss" class="relative block w-44">
                <img alt="Powered by Vercel" loading="lazy" width="50" height="25" decoding="async"
                     src="https://larazeus.com/images/zeus-logo.png" style="color: transparent;">
            </a>
        </div>
        <div class="inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" aria-hidden="true" class="w-4 h-4 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"></path>
            </svg>
            <select name="themeSwitch">
                <option value="system">System</option>
                <option value="dark">Dark</option>
                <option value="light">Light</option>
            </select>
        </div>
    </div>
</footer>



{{--@if(isset($header) || isset($breadcrumps))
    <div class="bg-gray-100 dark:bg-gray-800">
        <div class="container mx-auto py-2 px-3">

            @if(isset($header))
                <div class="italic font-semibold text-xl text-gray-600 dark:text-gray-100">
                    {{ $header }}
                </div>
            @endif

            @if(isset($breadcrumps))
                <nav class="text-gray-400 font-bold my-2" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center">
                            <a href="{{ route('blogs') }}">Home</a>
                            <x-iconpark-rightsmall-o class="fill-current w-4 h-4 mx-3" />
                        </li>
                        {{ $breadcrumps }}
                    </ol>
                </nav>
            @endif

        </div>
    </div>
@endif--}}

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
