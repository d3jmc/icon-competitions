@props(['competition'])

<div class="border border-gray-500 rounded">
    <div class="flex flex-col gap-4 p-8">
        <div class="max-w-[250px] py-2 px-4 mx-auto -mt-[55px] font-medium text-center bg-secondary text-primary rounded">{{ \Carbon\Carbon::parse($competition->start_date)->format('D d M') }} - {{ \Carbon\Carbon::parse($competition->end_date)->format('D d M') }}</div>
        <img src="//placehold.it/500x500" alt="" class="rounded" />
        <ul class="grid grid-cols-3 gap-4 font-semibold">
            <li class="flex flex-col gap-2 text-center">
                <p>Price</p>
                <div class="p-2 text-center bg-secondary text-primary rounded">£{{ number_format($competition->ticket_price, 2) }}</div>
            </li>
            <li class="flex flex-col gap-2 text-center">
                <p>Instant Wins</p>
                <div class="p-2 text-center bg-secondary text-primary rounded">{{ $competition->instant_win_tickets_count }}</div>
            </li>
            <li class="flex flex-col gap-2 text-center">
                <p>Tickets</p>
                <div class="p-2 text-center bg-secondary text-primary rounded">{{ $competition->tickets_count }}</div>
            </li>
        </ul>
        <div class="p-3 bg-gray-800 rounded">
            <div class="w-[25%] p-1 bg-secondary rounded"></div>
        </div>
    </div>
    <x-button href="#" label="Enter Competition" xl secondary class="w-full" />
</div>