<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="format-detection" content="telephone=no" />
        <meta property="og:description" content="RMMW은 파충류 메이팅 관리 웹으로 키우실 때 많은 도움을 받으실 수 있습니다." />
        <meta property="og:title" content="RMMW, 파충류 관리" />
        <meta name="twitter:site" content="@RMMW" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta property="og:locale" content="ko_KR" />
        <meta property="og:type" content="product" />
        <meta property="og:url" content="http://rmmw.kr/"/>
        <meta property="og:site_name" content="RMMW" />
        <meta name="description" content="RMMW은 파충류 메이팅 관리 웹으로 키우실 때 많은 도움을 받으실 수 있습니다."/>

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        @include('parts.favicon')

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-ES784GV65G"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-ES784GV65G');
        </script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
