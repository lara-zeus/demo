<!DOCTYPE html>
<html lang="en">
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
    @vite(['resources/css/app.css', 'resources/css/flag-icons.css'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 @if(app()->isLocal()) debug-screens @endif">
<div class="max-w-7xl mx-auto flex items-center justify-center h-screen flex-row lg:relative">
    <div class="flex-grow flex flex-col">
        <main class="flex-grow flex flex-col">
            <div class="flex-grow mx-auto w-full flex flex-col px-4 sm:px-6 lg:px-8">
                <div class="flex-shrink-0 pt-10 sm:pt-16">
                    <a class="italic flex gap-2 group " href="{{ url('/') }}">
                        <img class="w-12 sm:w-14" src="{{ asset('images/zeus-logo.png') }}" alt="">
                        <span class="text-3xl sm:text-4xl mt-2 title-font">@zeusz</span>
                    </a>
                </div>
                <div class="flex-shrink-0 my-auto py-16 sm:py-32">
                    <p class="text-sm font-semibold text-red-500 uppercase tracking-wide">@yield('code')</p>
                    <h1 class="mt-2 text-4xl font-extrabold text-secondary-500 tracking-tight sm:text-5xl">@yield('message')</h1>
                    <p class="mt-2 text-base text-gray-500"></p>
                    {{--<div class="mt-6">
                        <div class="flex items-center justify-start gap-2">
                            <svg class="w-8 h-8 text-secondary-500" width="24" height="24" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.75 12H6.75M6.75 12L9.5 14.75M6.75 12L9.5 9.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M2 15V9C2 6.79086 3.79086 5 6 5H18C20.2091 5 22 6.79086 22 9V15C22 17.2091 20.2091 19 18 19H6C3.79086 19 2 17.2091 2 15Z" stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            <a href="{{ url('/') }}" class="text-gray-600 underline underline-offset-2 decoration-primary-500 hover:decoration-secondary-500">
                                Back To @zeusz Site
                            </a>
                        </div>
                    </div>--}}
                </div>
            </div>
        </main>
    </div>
    <div class="hidden lg:block lg:right-0 lg:w-1/2 flex place-content-center">
        <img class="inset-0 object-cover" src="{{ asset( ($__env->yieldContent('image')) ? $__env->yieldContent('image') : 'images/undraw_bug_fixing_oc-7-a.svg' ) }}" alt="">
    </div>
</div>

</body>
</html>
