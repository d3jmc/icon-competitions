<?php

namespace App\DTOs;

use App\Models\Competition;
use App\Models\User;
use D3jmc\DataTransferObject\DataTransferObject;
use Illuminate\Database\Eloquent\Collection;

class PurchaseTicketsDto extends DataTransferObject
{
    public User $user;
    public Competition $competition;
    public Collection $tickets;
    public int $amount;

    // custom properties
    public float $totalPrice = 0;
    public float $totalPriceForStripe = 0;

    /**
     * @return void
     */
    public function setTotalPrice(): void
    {
        $this->totalPrice = ($this->competition->ticket_price * $this->amount);
    }

    /**
     * @return void
     */
    public function setTotalPriceForStripe(): void
    {
        $this->totalPriceForStripe = ($this->totalPrice * 100);
    }
}