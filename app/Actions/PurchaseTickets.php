<?php

namespace App\Actions;

use App\Dtos\PurchaseTicketsDto;
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
     * @param  User               $user
     * @param  Competition        $competition
     * @param  int                $amount
     * @param  bool               $charge
     *
     * @return PurchaseTicketsDto
     */
    public function handle(User $user, Competition $competition, int $amount, bool $charge = true): PurchaseTicketsDto
    {
        $dto = new PurchaseTicketsDto([
            'user' => $user,
            'competition' => $competition,
            'amount' => $amount,
        ]);

        $steps = [
            ReserveTickets::class,
            ClaimTickets::class,
        ];

        if ($charge) {
            array_splice($steps, 0, 0, CheckUserBalance::class);
            array_splice($steps, 2, 0, TakePayment::class);
        }

        return app(Pipeline::class)
            ->send($dto)
            ->through($steps)
            ->thenReturn();
    }
}