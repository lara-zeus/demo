<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Seo Tags -->
        <x-seo::meta/>
        <!-- Seo Tags -->

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Karla:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">

        <link rel="stylesheet" href="{{ mix('css/another-portfolio.css') }}">
        <link rel="stylesheet" href="{{ mix('css/flag-icons.css') }}">

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @livewireStyles
        @stack('styles')
    </head>

    <body x-data="{show:false}" class="antialiased bg-secondary-50 dark:bg-secondary-900">
        <div class="max-w-7xl mx-auto min-h-screen">

            @include($artemisTheme.'.layouts.navigation')

            @if(isset($header) || isset($breadcrumbs))
                <div class="bg-gray-500/10 dark:bg-gray-800 my-4">
                    <div class="max-w-7xl mx-auto py-2 px-10">
                        @if(isset($header))
                            <div class="italic font-semibold text-xl text-custom-600 dark:text-gray-100">
                                {{ $header }}
                            </div>
                        @endif

                        @if(isset($breadcrumbs))
                            <nav class="text-gray-400 font-bold my-2" aria-label="Breadcrumb">
                                <ol class="list-none p-0 inline-flex">
                                    <li class="flex items-center">
                                        <a href="{{ url('/') }}">{{ __('Home') }}</a>
                                        @svg('heroicon-m-arrow-small-right','fill-current w-4 h-4 mx-3 rtl:rotate-180')
                                    </li>
                                    {{ $breadcrumbs }}
                                </ol>
                            </nav>
                        @endif
                    </div>
                </div>
            @endif

            <main class="px-10"
                x-cloak x-show="show"
                x-transition.duration.500ms.opacity.scale x-init="$nextTick(() => show = true)"
            >
                {{ $slot }}
            </main>

            <div class="text-center text-xs font-karla text-gray-400 my-10">
                © All rights reserved
            </div>
        </div>

        @stack('scripts')
        @livewireScripts
        @filamentScripts
        @livewire('notifications')

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('container', () => ({
                    show: false
                }))
            })
            const theme = localStorage.getItem('theme')

            if ((theme === 'dark') || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
            }
        </script>
        <script src="{{ mix('js/another-portfolio.js') }}"></script>
        @stillStats(f6ce3271-8bf4-4b41-bea5-07d10f9ac5c9)
    </body>
</html>
