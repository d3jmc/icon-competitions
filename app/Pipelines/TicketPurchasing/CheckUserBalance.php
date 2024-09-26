<?php

namespace App\Pipelines\TicketPurchasing;

use App\DTOs\PurchaseTicketsDto;
use App\Exceptions\InsufficientFundsException;
use Closure;

class CheckUserBalance
{
    /**
     * @param PurchaseTicketsDto $dto
     * @param Closure $next
     * @return PurchaseTicketsDto
     */
    public function handle(PurchaseTicketsDto $dto, Closure $next): PurchaseTicketsDto
    {
        if ($dto->user->rawBalance() < $dto->totalPriceForStripe) {
            throw new InsufficientFundsException(__('Insufficient funds. Please top-up your wallet to continue.'));
        }

        return $next($dto);
    }
}