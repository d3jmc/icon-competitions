@props(['competition'])

@php
    $ticketsCount = number_format($competition->tickets_count);
    $instantWinsCount = number_format($competition->instant_win_tickets_count);
    $claimedTicketsCount = number_format($competition->claimed_tickets_count);
    $remainingTicketsCount = number_format($competition->tickets_count - $competition->claimed_tickets_count);
    $percentageOfClaiedTickets = $competition->percentageOfClaimedTickets();

    $stats = [
        ['title' => 'Price', 'value' => '£' . $competition->ticket_price],
        ['title' => 'Instant Wins', 'value' => $instantWinsCount],
        ['title' => 'Tickets', 'value' => $ticketsCount],
    ];
@endphp

<div class="border border-secondary rounded">
    <div class="flex flex-col gap-4 p-8">
        <div class="max-w-[250px] py-2 px-4 mx-auto -mt-[55px] font-medium text-center bg-secondary text-primary rounded">{{ \Carbon\Carbon::parse($competition->start_date)->format('D d M') }} - {{ \Carbon\Carbon::parse($competition->end_date)->format('D d M') }}</div>
         <img src="{{ $competition->thumbnail ?? '//placehold.it/500x500' }}" alt="{{ $competition->name }}" class="rounded" />
        <ul class="grid grid-cols-3 gap-4 font-medium">
            @foreach ($stats as $stat)
                <li class="flex flex-col gap-2 text-center">
                    <p>{{ $stat['title'] }}</p>
                    <div class="p-2 text-center bg-secondary text-primary rounded">{{ $stat['value'] }}</div>
                </li>
            @endforeach
        </ul>
        <div class="p-3 border border-secondary rounded">
            <div class="p-1 bg-secondary rounded" title="{{ $percentageOfClaiedTickets }}% of tickets claimed" style="width: {{ $percentageOfClaiedTickets }}%"></div>
        </div>
        <div class="flex gap-4 justify-between">
            <p class="text-sm text-left">Sold {{ $claimedTicketsCount }} / {{ $ticketsCount }}</p>
            <p class="text-sm text-left">Remaining {{ $remainingTicketsCount }}</p>
        </div>
    </div>
    <x-button wire:navigate href="{{ route('competition.show', $competition->slug) }}" label="View Competition" xl secondary class="w-full !text-black font-medium rounded-t-none" />
</div>