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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Almarai:wght@300;400;700;800&family=Reggae+One&display=swap" rel="stylesheet">

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
    @if(session('current_theme') === 'daisy')
        <link rel="stylesheet" href="{{ mix('css/daisy.css') }}">
    @else
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/flag-icons.css') }}">
</head>

<body class="@if(session('current_theme') === 'zeus') bg-[#F7FBF8] @else bg-gray-50 @endif dark:bg-gray-900 @if(app()->isLocal()) debug-screens @endif">

<div x-data class="inset-0 min-h-screen flex items-center justify-center">
    <div class="container mx-auto">
        {{ $slot }}
    </div>
</div>

@livewireScripts
@filamentScripts
@stack('scripts')
@stillStats(f6ce3271-8bf4-4b41-bea5-07d10f9ac5c9)
@if(!app()->isLocal())
    <script defer src="https://api.pirsch.io/pa.js"
            id="pianjs"
            data-code="Uh1FIJELPPoLoE0fVHmOa1CawfHOeQlC"></script>
@endif
<script>
    const theme = localStorage.getItem('theme')

    if ((theme === 'dark') || (! theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    }
</script>

<script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
