<?php

namespace App\Pipelines\TicketGeneration;

use App\Enums\TicketType;
use App\Models\Competition;
use App\Models\Prize;
use App\Models\Ticket;
use Closure;

class AssignPrizesToTickets
{
    /**
     * @param Competition $competition
     * @param Closure $next
     * @return Competition
     */
    public function handle(Competition $competition, Closure $next): Competition
    {
        $competition->tickets->each(function (Ticket $ticket) use ($competition) {
            $attributes = [];

            if ($prize = $this->getPrize($competition, $ticket->type)) {
                $attributes['prize_id'] = $prize->id;
            } else {
                $attributes['type'] = TicketType::STANDARD;
            }

            $ticket->update($attributes);
        });

        return $next($competition);
    }

    /**
     * @param Competition $competition
     * @param TicketType $ticketType
     * @return Prize|null
     */
    private function getPrize(Competition $competition, TicketType $ticketType): ?Prize
    {
        $prizes = $competition
            ->prizes()
            ->assignable()
            ->forTicketType($ticketType)
            ->get();
        
        if ($prizes->count() == 0) {
            return null;
        }

        $prize = $prizes->random();
        $prize->update([
            'assigned' => ($prize->assigned + 1),
        ]);

        return $prize;
    }
}