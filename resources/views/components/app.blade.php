<!doctype html>
<html dir="{{ (app()->getLocale() === 'ar') ? 'rtl' : 'ltr' }}" class="antialiased filament js-focus-visible">
<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="icon" href="{{ asset('favicon.ico?v=0.1') }}">

    @php
        seo()
        ->title('Lara Zeus Demo App')
        ->description('demo app for all lara zeus packages')
        ->site('https://larazeus.com/')
        ->image(asset('images/demo-banner.png'))
        ->twitter()
        ->twitterCreator('atmonshi')
        ->twitterSite('https://twitter.com/atmonshi')
        ->twitterTitle('Lara Zeus Demo')
        ->twitterDescription('wind, sky, and bolt all the demos for all lara zeus packages')
        ->twitterImage(asset('images/demo-banner.png'))
        ->favicon()
        ->withUrl()
        ;
    @endphp

    <x-seo::meta />

    @livewireStyles
    @filamentStyles
    <style>
        [x-cloak=""], [x-cloak="x-cloak"], [x-cloak="1"] { display: none !important; }
        @media (max-width: 1023px) { [x-cloak="-lg"] { display: none !important; } }
        @media (min-width: 1024px) { [x-cloak="lg"] { display: none !important; } }
        @if(app()->isLocal())
            /*a css debugging tool 😜*/
            .bord {border: solid 1px crimson}
        @endif
    </style>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body class="bg-gray-50 dark:bg-gray-900 @if(app()->isLocal()) debug-screens @endif">

<div x-data class="inset-0 min-h-screen flex items-center justify-center">
    <div class="container mx-auto">
        {{ $slot }}
    </div>
</div>

@livewireScripts
@filamentScripts
@stack('scripts')
@stillStats(f6ce3271-8bf4-4b41-bea5-07d10f9ac5c9)
<script>
    const theme = localStorage.getItem('theme')

    if ((theme === 'dark') || (! theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    }
</script>

<script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
