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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Almarai:wght@300;400;700;800&family=Reggae+One&display=swap" rel="stylesheet">

    @livewireStyles
    @filamentStyles
    @stack('styles')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/zeus/frontend.css') }}">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:text-gray-100 dark:bg-gray-900 @if(app()->isLocal()) debug-screens @endif">

<header x-data="{ open: false }" class="bg-white dark:bg-black py-4">
    <x-nav/>
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

@php
    $urls = [
        'wind'=>'lara-zeus/wind',
        'bolt'=>'lara-zeus/bolt',
        'sky'=>'lara-zeus/sky',
        'thunder'=>'lara-zeus/thunder',
        'rain'=>'lara-zeus/rain',
    ];
    $packageName = (isset($urls[explode('/',request()->path())[0]])) ? $urls[explode('/',request()->path())[0]] : null;
@endphp
<footer class="bg-gray-100 dark:bg-gray-800 p-6 pt-20 text-center font-light">
    <a href="https://larazeus.com" target="_blank">
        a gift with ❤️ &nbsp;from @zeus
    </a>
    @if($packageName !== null)
        <a target="_blank" href="https://github.com/{{ $packageName }}" class="block py-2 px-4 text-gray-900">
            {{ $packageName }} v:{{ \Composer\InstalledVersions::getVersion($packageName) }}
        </a>
    @endif
</footer>

@stack('scripts')
@filamentScripts
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
