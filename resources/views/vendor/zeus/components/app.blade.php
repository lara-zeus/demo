<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? "rtl" : 'ltr' }}"
      class="antialiased filament js-focus-visible">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name', 'Laravel') }}">

    <!-- Seo Tags -->
    <x-seo::meta/>
    <!-- Seo Tags -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Almarai:wght@300;400;700;800&family=Reggae+One&display=swap"
        rel="stylesheet">

    @livewireStyles
    @filamentStyles
    @stack('styles')

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/flag-icons.css') }}">

    <style>
        * {font-family: 'KoHo', 'Almarai', sans-serif;}
        [x-cloak] {display: none !important;}
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-900 dark:text-gray-100 dark:bg-gray-900 @if(app()->isLocal()) debug-screens @endif">

<x-banner/>

<header x-data="{ open: false }" class="mt-12 bg-white dark:bg-black py-4">
    <x-nav/>
</header>

<header class="bg-gray-100 dark:bg-gray-800">
    <div class="container mx-auto py-2 px-3">
        <div class="flex justify-between items-center">
            <div class="w-full">
                @if(isset($breadcrumbs))
                    <nav class="text-gray-400 font-bold my-1" aria-label="Breadcrumb">
                        <ol class="list-none p-0 inline-flex">
                            {{ $breadcrumbs }}
                        </ol>
                    </nav>
                @endif
                @if(isset($header))
                    <div class="italic font-semibold text-xl text-gray-600 dark:text-gray-100">
                        {{ $header }}
                    </div>
                @endif
            </div>
            <span class="bolt-loading animate-pulse"></span>
        </div>
    </div>
</header>

<div class="container mx-auto py-10">
    {{ $slot }}
</div>

@php
    $urls = [
        'wind'=>'lara-zeus/wind',
        'bolt'=>'lara-zeus/bolt',
        'sky'=>'lara-zeus/sky',
        'thunder'=>'lara-zeus/thunder',
        'dynamic-dashboard'=>'lara-zeus/dynamic-dashboard',
    ];
    $packageName = (isset($urls[explode('/',request()->path())[0]])) ? $urls[explode('/',request()->path())[0]] : null;
@endphp

<div class="doc-list my-10">
    @if(app()->isProduction())
        <script async type="text/javascript" id="_carbonads_js"
                src="//cdn.carbonads.com/carbon.js?serve=CWYIVK3J&placement=larazeuscom">
        </script>
    @endif
    <div class="text-center my-4 text-sm">
        Running @zeus packages and the website doesn't come for free. You can help support us by checking out relevant sponsors from the banner above.
    </div>
</div>

<footer class="bg-gray-100 dark:bg-gray-800 p-6 pt-10 flex flex-col items-center justify-center text-center font-light">

    <a href="https://larazeus.com" target="_blank">
        a gift with ❤️ &nbsp;from @zeus
    </a>

    @if($packageName !== null)
        <a target="_blank" href="https://github.com/{{ $packageName }}" class="block py-2 px-4 text-gray-900">
            {{ $packageName }} v:{{ \Composer\InstalledVersions::getVersion($packageName) }}
        </a>
    @endif

    <div class="flex gap-2">
        <a href="https://github.com/lara-zeus" target="_blank">
            @svg('ri-github-fill','h-8 w-8 text-secondary-500 hover:text-custom-500 transition-all ease-in-out duration-300')
        </a>

        <a href="https://twitter.com/larazeus" target="_blank">
            @svg('ri-twitter-line','h-8 w-8 text-secondary-500 hover:text-custom-500 transition-all ease-in-out duration-300')
        </a>
    </div>
</footer>

@livewireScripts
@filamentScripts
@livewire('notifications')
@livewire('livewire-ui-modal')
@stack('scripts')

<script>
    const theme = localStorage.getItem('theme')

    if ((theme === 'dark') || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    }
</script>
@stillStats(f6ce3271-8bf4-4b41-bea5-07d10f9ac5c9)
</body>
</html>
