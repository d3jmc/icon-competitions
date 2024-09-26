<?php

namespace App\Pipelines\TicketGeneration;

use App\Models\Competition;
use App\Models\Ticket;
use Closure;

class CreateTickets
{
    /**
     * @param Competition $competition
     * @param Closure $next
     * @return Competition
     */
    public function handle(Competition $competition, Closure $next): Competition
    {
        Ticket::factory()
            ->count($competition->max_tickets)
            ->for($competition)
            ->create();
        
        return $next($competition);
    }
}