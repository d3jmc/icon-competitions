<?php

namespace App\Pipelines\TicketGeneration;

use App\Enums\TicketType;
use App\Models\Competition;
use Closure;
use Illuminate\Database\Eloquent\Collection;

class ConvertTickets
{
    /**
     * @param Competition $competition
     * @param Closure $next
     * @return void
     */
    public function handle(Competition $competition, Closure $next)
    {
        if ($numberOfInstantWinTickets = $competition->instant_wins) {
            $this->convertTo(TicketType::INSTANT_WIN, $competition->tickets->random($numberOfInstantWinTickets));
        }

        return $next($competition);
    }

    /**
     * @param TicketType $ticketType
     * @param Collection $tickets
     * @return void
     */
    private function convertTo(TicketType $ticketType, Collection $tickets): void
    {
        foreach ($tickets as $ticket) {
            $ticket->update([
                'type' => $ticketType,
            ]);
        }
    }
}