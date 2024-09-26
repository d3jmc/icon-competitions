<?php

namespace App\Actions;

use App\DTOs\PurchaseTicketsDto;
use App\Models\Competition;
use App\Models\User;
use App\Pipelines\TicketPurchasing\CheckUserBalance;
use App\Pipelines\TicketPurchasing\ClaimTickets;
use App\Pipelines\TicketPurchasing\ReserveTickets;
use App\Pipelines\TicketPurchasing\TakePayment;
use Illuminate\Pipeline\Pipeline;

class PurchaseTickets
{
    /**
     * @param User $user
     * @param Competition $competition
     * @param int $amount
     * @return PurchaseTicketsDto
     */
    public function handle(User $user, Competition $competition, int $amount): PurchaseTicketsDto
    {
        $dto = new PurchaseTicketsDto([
            'user' => $user,
            'competition' => $competition,
            'amount' => $amount,
        ]);

        return app(Pipeline::class)
            ->send($dto)
            ->through([
                CheckUserBalance::class,
                ReserveTickets::class,
                TakePayment::class,
                ClaimTickets::class,
            ])
            ->thenReturn();
    }
}