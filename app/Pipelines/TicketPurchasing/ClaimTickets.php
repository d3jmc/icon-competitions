<?php

namespace App\Pipelines\TicketPurchasing;

use App\DTOs\PurchaseTicketsDto;
use Closure;

class ClaimTickets
{
    /**
     * @param PurchaseTicketsDto $dto
     * @param Closure $next
     * @return PurchaseTicketsDto
     */
    public function handle(PurchaseTicketsDto $dto, Closure $next): PurchaseTicketsDto
    {
        foreach ($dto->tickets as $ticket) {
            $ticket->claim($ticket->user_id);
        }

        return $next($dto);
    }
}