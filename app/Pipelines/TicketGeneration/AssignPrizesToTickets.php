<?php

namespace App\Pipelines\TicketGeneration;

use App\Enums\TicketType;
use App\Exceptions\NoPrizesForTicketType;
use App\Models\Competition;
use App\Models\Prize;
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
        $competition->tickets
                    ->where('type', '!=', TicketType::STANDARD)
                    ->each(fn (Ticket $ticket) => $this->assignPrize($ticket));

        return $next($competition);
    }

    /**
     * @param  Ticket $ticket
     *
     * @return void
     */
    private function assignPrize(Ticket $ticket): void
    {
        try {
            $prize = $this->getRandomPrize($ticket->competition, $ticket->type);

            $ticket->update([
                'prize_id' => $prize->id,
            ]);
        } catch (NoPrizesForTicketType) {
            $ticket->update([
                'type' => TicketType::STANDARD,
            ]);
        }
    }

    /**
     * @param  Competition $competition
     * @param  TicketType  $ticketType
     *
     * @return Prize
     */
    private function getRandomPrize(Competition $competition, TicketType $ticketType): Prize
    {
        $prizes = $competition->prizes()->assignable()->forTicketType($ticketType)->get();
        
        if ($prizes->count() == 0) {
            throw new NoPrizesForTicketType('No prizes available for this ticket type.');
        }

        $prize = $prizes->random();

        $prize->update([
            'assigned' => ($prize->assigned + 1),
        ]);

        return $prize;
    }
}