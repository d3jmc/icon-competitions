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
        <header class="sticky top-0 z-10 py-4 bg-black border-b-4 border-secondary">
            <div class="flex justify-between items-center gap-8 container">
                <a class="flex" href="{{ route('home') }}" wire:navigate>
                    <x-application-logo fill="white" />
                </a>
                <nav class="flex items-center gap-8">
                    <x-link wire:navigate label="Live Competitions" href="{{ route('competitions') }}" class="!font-normal" />
                    <x-link wire:navigate label="Past Competitions" href="{{ route('past-competitions') }}" class="!font-normal" />
                    <x-link wire:navigate label="About" href="{{ route('about') }}" class="!font-normal" />
                    <x-link wire:navigate label="FAQs" href="{{ route('faqs') }}" class="!font-normal" />
                    <div class="flex gap-4">
                        @if (auth()->user())
                            <x-button href="{{ route('account') }}" label="Account" secondary />
                        @else
                            <x-button href="{{ route('register') }}" label="Sign up" secondary outline />
                            <x-button href="{{ route('login') }}" label="Sign in" right-icon="arrow-right" secondary class="!text-black" />
                        @endif
                    </div>
                </nav>
            </div>
        </header>
        <main>
            {{ $slot }}
        </main>
        <footer></footer>
    </body>
</html>
