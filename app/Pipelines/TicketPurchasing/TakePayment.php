<?php

namespace App\Pipelines\TicketPurchasing;

use App\Dtos\PurchaseTicketsDto;
use Closure;

class TakePayment
{
    /**
     * @param  PurchaseTicketsDto $dto
     * @param  Closure            $next
     *
     * @return PurchaseTicketsDto
     */
    public function handle(PurchaseTicketsDto $dto, Closure $next): PurchaseTicketsDto
    {
        $dto->user->wallet->withdraw($dto->totalPrice, "Purchase of {$dto->amount} ticket(s).", ['ticket_ids' => $dto->tickets->pluck('id')->toArray()]);

        return $next($dto);
    }
}