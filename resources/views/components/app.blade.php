<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=KoHo:ital,wght@0,200;0,300;0,500;0,700;1,200;1,300;1,600;1,700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'KoHo', 'Almarai', sans-serif;
        }

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
<body class="bg-gray-50">

<div class="inset-0 sm:h-screen flex items-center">
    <div class="container mx-auto">
        {{ $slot }}
    </div>
</div>
</body>
</html>
