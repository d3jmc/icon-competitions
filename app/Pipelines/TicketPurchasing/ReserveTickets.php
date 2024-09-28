<?php

namespace App\Pipelines\TicketPurchasing;

use App\DTOs\PurchaseTicketsDto;
use App\Exceptions\NotEnoughTicketsRequestedException;
use App\Exceptions\TooManyTicketsRequestedException;
use Closure;

class ReserveTickets
{
    /**
     * @param PurchaseTicketsDto $dto
     * @param Closure $next
     * @return PurchaseTicketsDto
     */
    public function handle(PurchaseTicketsDto $dto, Closure $next): PurchaseTicketsDto
    {
        if ($dto->amount < $dto->competition->min_tickets_per_user) {
            throw new NotEnoughTicketsRequestedException(__("You must select a minimum of {$dto->competition->min_tickets_per_user} tickets."));
        }

        if ($dto->competition->max_tickets_per_user > -1 && $dto->amount > $dto->competition->max_tickets_per_user) {
            throw new TooManyTicketsRequestedException(__("You must select less than {$dto->competition->max_tickets_per_user} tickets."));
        }

        $unclaimedTickets = $dto->competition->tickets()->unclaimed()->get();

        if ($dto->amount > $unclaimedTickets->count()) {
            throw new TooManyTicketsRequestedException(__('You have selected more tickets than there are available.'));
        }

        $randomTickets = $unclaimedTickets->random($dto->amount);

        $randomTickets->each->reserve($dto->user->id);
 
        $dto->fill([
            'tickets' => $randomTickets,
        ]);

        return $next($dto);
    }
}