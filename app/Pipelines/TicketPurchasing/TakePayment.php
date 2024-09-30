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
        $dto->user->creditBalance($dto->totalPriceForStripe, "Purchase of {$dto->amount} ticket(s).");

        return $next($dto);
    }
}