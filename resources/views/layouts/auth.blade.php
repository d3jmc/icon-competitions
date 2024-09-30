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
    <body class="font-body">
        <div class="grid xl:grid-cols-2 min-h-screen">
            <div class="h-full bg-white container">
                <div class="py-4">
                    <a class="flex" href="{{ route('home') }}" wire:navigate>
                        <x-application-logo />
                    </a>
                </div>

                <div class="flex flex-col justify-center gap-8 max-w-[480px] min-h-[calc(100%-136px)] py-20 mx-auto">
                    @if (session('message'))
                        <x-alert :title="session('message')" positive />
                    @endif

                    {{ $slot }}
                </div>
            </div>
            <div class="hidden xl:block sticky top-0 h-screen bg-secondary overflow-hidden">
                <div class="absolute top-[2rem] right-[6rem] w-[26rem] h-[26rem] bg-primary rounded-full z-0" style="background-position: 25% -83%; background-size: 90%; transform: translate(50%, -50%);"></div>
                <div class="absolute top-[2rem] right-[6rem] w-[22rem] h-[22rem] rounded-full border-[25px] border-secondary" style="transform: translate(50%, -50%);"></div>
                <div class="absolute top-[2rem] right-[6rem] w-[14rem] h-[14rem] rounded-full border-[25px] border-secondary" style="transform: translate(50%, -50%);"></div>
                <div class="flex h-full p-16">
                    <div class="flex flex-col gap-4 mt-auto">
                        <p class="text-5xl xl:text-6xl">The best odds, <span class="font-bold">guaranteed.</span></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
