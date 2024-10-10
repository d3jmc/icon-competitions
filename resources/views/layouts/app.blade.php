<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <title>{{ $title ?? '' }} | Icon Competitions</title>

        @wireUiScripts

        @vite('resources/css/app.css')
    </head>
    <body class="font-body bg-black text-white">
        <x-header />
        <main>
            {{ $slot }}
        </main>
        <footer></footer>
    </body>
</html>
