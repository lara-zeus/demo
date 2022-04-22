<!doctype html>
<html dir="{{ __('dir') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="icon" href="{{ asset('favicon.ico?v=0.1') }}">

    <style>
        [x-cloak] {
            display: none !important;
        }

        @if(app()->isLocal())
        .bord {
            border: solid 1px crimson
        }
        @endif
    </style>
</head>
<body class="bg-gray-50 rtl:font-el-messiri ltr:font-koho @if(app()->isLocal()) debug-screens @endif">
<div class="inset-0 min-h-screen flex items-center justify-center">
    <div class="container mx-auto">
        {{ $slot }}
    </div>
</div>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@atmStats(f6ce3271-8bf4-4b41-bea5-07d10f9ac5c9)
</body>
</html>
