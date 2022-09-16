<!doctype html>
<html dir="{{ __('dir') }}" class="antialiased filament js-focus-visible">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

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

    <style>
        [x-cloak] {display: none !important;}
        @if(app()->isLocal())
            /*a css debugging tool 😜*/
            .bord {border: solid 1px crimson}
        @endif
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 @if(app()->isLocal()) debug-screens @endif">
<div class="inset-0 min-h-screen flex items-center justify-center">
    <div class="container mx-auto">
        {{ $slot }}
    </div>
</div>
<script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
@atmStats(f6ce3271-8bf4-4b41-bea5-07d10f9ac5c9)
<script>
    const theme = localStorage.getItem('theme')

    if ((theme === 'dark') || (! theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark')
    }
</script>
</body>
</html>
