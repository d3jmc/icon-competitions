<?php

namespace App\Pipelines\TicketGeneration;

use App\Enums\TicketType;
use App\Models\Competition;
use App\Models\Ticket;
use Closure;

class AssignPrizesToTickets
{
    /**
     * @param  Competition $competition
     * @param  Closure     $next
     *
     * @return Competition
     */
    public function handle(Competition $competition, Closure $next): Competition
    {
        $competition->tickets->each(fn (Ticket $ticket) => $this->assignPrize($competition, $ticket));

        return $next($competition);
    }

    /**
     * @param  Competition $competition
     * @param  Ticket      $ticket
     *
     * @return void
     */
    private function assignPrize(Competition $competition, Ticket $ticket): void
    {
        if ($ticket->type === TicketType::STANDARD) {
            return;
        }

        $prizes = $competition->prizes()->assignable()->forTicketType($ticket->type)->get();

        if ($prizes->count() > 0) {
            $prize = $prizes->random();
            
            $prize->update(['assigned' => ($prize->assigned + 1)]);

            $ticket->update(['prize_id' => $prize->id]);

            return;
        }

        $ticket->update(['type' => TicketType::STANDARD]);
    }
}