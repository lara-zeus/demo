<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('filament::layout.direction') ?? 'ltr' }}">
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

    <link rel="stylesheet" href="{{ asset('vendor/zeus/app.css') }}">
    @livewireStyles
    @stack('styles')

    <style>
        * {font-family: 'KoHo', 'Almarai', sans-serif;}
        [x-cloak] {display: none !important;}
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">

<nav x-data="{ open: false }" class="bg-white border-0 border-gray-100 px-4">
    <div class="container mx-auto">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a class="italic flex gap-2 group" href="{{ url('/') }}">
                        <img class="w-7" src="https://larazeus.com/images/zeus-logo.png" alt="{{ config('zeus.wind.name', config('app.name', 'Laravel')) }}">
                        @zeus
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    {{--Navigation Links--}}
                </div>

            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                {{--Account menu and other icons--}}
            </div>
        </div>
    </div>
</nav>

@if(isset($header) || isset($breadcrumps))
    <header class="bg-gray-100">
        <div class="container mx-auto py-2 px-3">
            @if(isset($header))
                <div class="italic font-semibold text-xl text-gray-600">
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
    </header>
@endif

<main class="flex container mx-auto">
    <div class="flex-grow">
        {{ $slot }}
    </div>
</main>

<footer class="bg-gray-100 p-6 mt-20">
    <a href="https://larazeus.com" target="_blank" class="text-center font-light block">
        a gift with ❤️ &nbsp;from @zeus
    </a>
</footer>

<script src="{{ asset('vendor/zeus/app.js') }}" defer></script>

@livewireScripts
@stack('scripts')
@atmStats(f6ce3271-8bf4-4b41-bea5-07d10f9ac5c9)

</body>
</html>
