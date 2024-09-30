<?php

namespace App\Pipelines\TicketPurchasing;

use App\Dtos\PurchaseTicketsDto;
use App\Events\TicketsPurchased;
use App\Models\Ticket;
use Closure;

class ClaimTickets
{
    /**
     * Undocumented function
     *
     * @param  PurchaseTicketsDto $dto
     * @param  Closure            $next
     *
     * @return PurchaseTicketsDto
     */
    public function handle(PurchaseTicketsDto $dto, Closure $next): PurchaseTicketsDto
    {
        $dto->tickets->each(fn (Ticket $ticket) => $ticket->claim($ticket->user_id));

        event(new TicketsPurchased($dto->user, $dto->tickets));

        return $next($dto);
    }
}