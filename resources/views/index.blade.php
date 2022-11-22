<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <ul>
            <li>
                <a href="{{route('type.create')}}">종류 등록</a>
            </li>
            <li>
                <a href="{{route('reptile.create')}}">개체 등록</a>
            </li>
            <li>
                <a href="{{route('mating.create')}}">메이팅 등록</a>
            </li>
            <li>
                <a href="{{route('egg.create')}}">알 등록</a>
            </li>
        </ul>
    </body>
</html>
