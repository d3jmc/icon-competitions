<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex, nofollow">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <title>{{ $title ?? '' }} | Icon Competitions</title>
        
        @wireUiScripts

        @vite('resources/css/app.css')
    </head>
    <body class="font-body">
        <x-header/>
        <main class="py-16 container">
            <div class="grid grid-cols-5 gap-16">
                <div class="col-span-1">
                    @php
                        $navigation = [
                            ['label' => 'Dashboard', 'icon' => 'home', 'href' => 'account'],
                            ['label' => 'My Profile', 'icon' => 'user', 'href' => 'account.profile'],
                            ['label' => 'My Tickets', 'icon' => 'ticket', 'href' => 'account.tickets'],
                            ['label' => 'My Transactions', 'icon' => 'wallet', 'href' => 'account.transactions'],
                            ['label' => 'Security', 'icon' => 'lock-closed', 'href' => 'account.security'],
                            ['label' => 'Logout', 'icon' => 'arrow-right-end-on-rectangle', 'href' => 'logout'],
                        ];
                    @endphp

                    <nav class="flex flex-col gap-4 text-left">
                        @foreach ($navigation as $item)
                            <x-button wire:navigate href="{{ route($item['href']) }}" label="{{ $item['label'] }}" @class([
                                'justify-between !px-0 !py-2 !text-left !font-normal !no-underline hover:bg-transparent hover:text-secondary !shadow-none',
                                'text-black' => !request()->routeIs($item['href']),
                                'text-secondary' => request()->routeIs($item['href'])
                            ]) lg flat right-icon="{{ $item['icon'] }}" />
                        @endforeach
                </div>
                <div class="col-span-4">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </body>
</html>
