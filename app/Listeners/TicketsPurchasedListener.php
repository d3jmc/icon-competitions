<?php

namespace App\Listeners;

use App\Events\TicketsPurchased;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class TicketsPurchasedListener
{
    /**
     * @param  TicketsPurchased $event
     *
     * @return void
     */
    public function handle(TicketsPurchased $event): void
    {
        Log::info('tickets purchased for user ' . $event->user->id, $event->tickets->toArray());
    }
}
