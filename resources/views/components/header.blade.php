@php
    $navigation = [
        //['label' => 'Live Competitions', 'href' => 'competitions'],
        //['label' => 'Past Competitions', 'href' => 'past-competitions'],
        //['label' => 'About', 'href' => 'about'],
        //['label' => 'FAQs', 'href' => 'faqs'],
    ];
@endphp

<header class="sticky top-0 z-20 py-4 bg-black text-white">
    <div class="-mt-4 mb-4 py-4 text-black bg-secondary text-center font-medium">
        <div class="container">
            <p>
                <span class="font-semibold mr-1">Limited Time Offer:</span>
                Sign up today and get £1 instant credit to your account.
            </p>
        </div>
    </div>
    <div class="flex justify-between items-center gap-8 container">
        <a class="flex" href="{{ route('home') }}" wire:navigate>
            <x-application-logo fill="white" />
        </a>
        <nav class="flex items-center gap-8">

            @foreach ($navigation as $item)
                <x-link wire:navigate label="{{ $item['label'] }}" href="{{ route($item['href']) }}" @class([
                    'hover:text-secondary-500 !font-normal !no-underline',
                    'text-white' => !request()->routeIs($item['href']),
                    'text-secondary-500' => request()->routeIs($item['href'])
                ]) />
            @endforeach

            <div class="flex gap-4">
                @if (auth()->user())
                    <x-button wire:navigate href="#" label="{{ auth()->user()->balance() }}" secondary outline icon="banknotes" />
                    <x-button wire:navigate href="{{ route('account') }}" label="My Account" primary right-icon="arrow-right" />
                @else
                    <x-button wire:navigate href="{{ route('register') }}" label="Sign up" secondary outline />
                    <x-button wire:navigate href="{{ route('login') }}" label="Sign in" primary right-icon="arrow-right" />
                @endif
            </div>
        </nav>
    </div>
</header>