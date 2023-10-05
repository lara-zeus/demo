<!DOCTYPE html data-theme>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? "rtl" : 'ltr' }}">
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
        href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Almarai:wght@300;400;700;800&family=Reggae+One&display=swap"
        rel="stylesheet">
    @livewireStyles
    @stack('styles')

    <link rel="stylesheet" href="{{ mix('css/flag-icons.css') }}">
    <link rel="stylesheet" href="{{ mix('css/daisy.css') }}">

    <style>
        * {font-family: 'KoHo', 'Almarai', sans-serif;}
        [x-cloak] {display: none !important;}
    </style>
</head>

@php $menu = RyanChandler\FilamentNavigation\Models\Navigation::fromHandle(config('zeus.header_menu')) @endphp

<body class="@if(app()->isLocal()) debug-screens @endif antialiased">

@include($artemisTheme.'.layouts.navigation')

@if(isset($header) || isset($breadcrumbs))
    <div class="container mx-auto py-4 my-4">
        <div class="alert shadow-lg flex flex-col items-start ltr:text-left rtl:text-right">
            @if(isset($header))
                <div class="italic font-semibold text-xl text-gray-600 dark:text-gray-100">
                    {{ $header }}
                </div>
            @endif

            @if(isset($breadcrumbs))
                <nav class="text-gray-400 font-bold my-2" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center">
                            <a href="{{ route('blogs') }}">Home</a>
                            @svg('iconpark-rightsmall-o','fill-current w-4 h-4 mx-3')
                        </li>
                        {{ $breadcrumbs }}
                    </ol>
                </nav>
            @endif
        </div>
    </div>
@endif

<div class="container mx-auto">
    {{ $slot }}
</div>

<footer class="mt-10 footer items-center p-4 bg-base-200 text-base-content">
    <div class="items-center grid-flow-col">
        <img alt="Lara Zeus" loading="lazy" width="40" height="20" decoding="async" src="https://larazeus.com/images/zeus-logo.png">
        <a href="https://larazeus.com" target="_blank">
            a gift with ❤️ &nbsp;from @zeus
        </a>
    </div>
    <div class="grid-flow-col gap-4 md:place-self-center md:justify-self-end">
        <a href="https://github.com/lara-zeus" target="_blank">
            @svg('ri-github-fill','h-8 w-8 text-secondary-500 hover:text-primary-500 transition-all ease-in-out duration-300')
        </a>
        <a href="https://twitter.com/larazeus" target="_blank">
            @svg('ri-twitter-line','h-8 w-8 text-secondary-500 hover:text-primary-500 transition-all ease-in-out duration-300')
        </a>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js"></script>

@stack('scripts')
@livewireScripts
@filamentScripts
@livewire('notifications')

<script>
    const theme = localStorage.getItem('theme')

    if ((theme === 'dark') || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    }
</script>

</body>
</html>