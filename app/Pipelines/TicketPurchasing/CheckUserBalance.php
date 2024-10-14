<?php

namespace App\Pipelines\TicketPurchasing;

use App\Dtos\PurchaseTicketsDto;
use App\Exceptions\InsufficientFundsException;
use Closure;

class CheckUserBalance
{
    /**
     * @param  PurchaseTicketsDto $dto
     * @param  Closure            $next
     *
     * @return PurchaseTicketsDto
     */
    public function handle(PurchaseTicketsDto $dto, Closure $next): PurchaseTicketsDto
    {
        if ($dto->user->wallet->balance < $dto->totalPrice) {
            throw new InsufficientFundsException('Insufficient funds. Please top-up your wallet to continue.');
        }

        return $next($dto);
    }
}