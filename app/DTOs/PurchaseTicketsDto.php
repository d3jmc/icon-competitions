<?php

namespace App\Dtos;

use App\Models\Competition;
use App\Models\User;
use D3jmc\DataTransferObject\DataTransferObject;
use Illuminate\Database\Eloquent\Collection;

class PurchaseTicketsDto extends DataTransferObject
{
    /**
     * @var User
     */
    public User $user;

    /**
     * @var Competition
     */
    public Competition $competition;

    /**
     * @var Collection
     */
    public Collection $tickets;

    /**
     * @var int
     */
    public int $amount;

    /**
     * @var float
     */
    public float $totalPrice = 0;

    /**
     * @var float
     */
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