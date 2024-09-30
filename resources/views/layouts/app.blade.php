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
    <body class="font-body bg-primary text-white">
        <header class="sticky top-0 z-10 py-4 bg-primary border-b-4 border-secondary">
            <div class="flex justify-between items-center gap-8 container">
                <a class="flex" href="{{ route('home') }}" wire:navigate>
                    <x-application-logo fill="white" />
                </a>
                <nav class="flex items-center gap-8">
                    <a href="{{ route('competitions') }}" class="font-medium" wire:navigate>Live Competitions</a>
                    <a href="{{ route('past-competitions') }}" class="font-medium" wire:navigate>Past Competitions</a>
                    <a href="{{ route('about') }}" class="font-medium" wire:navigate>About</a>
                    <a href="{{ route('faqs') }}" class="font-medium" wire:navigate>FAQs</a>
                    <div class="flex gap-4">
                        @if (auth()->user())
                            <a href="{{ route('account') }}" class="font-medium py-2 px-4 bg-secondary text-primary border border-secondary rounded" wire:navigate>Account &rightarrow;</a>
                        @else
                            <a href="{{ route('register') }}" class="font-medium py-2 px-4 border border-secondary rounded" wire:navigate>Sign up</a>
                            <a href="{{ route('login') }}" class="font-medium py-2 px-4 bg-secondary text-primary border border-secondary rounded" wire:navigate>Log in &rightarrow;</a>
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
