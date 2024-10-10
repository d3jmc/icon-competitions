<?php

namespace App\Listeners;

use App\Models\Promotion;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Log;

class VerifiedListener
{
    /**
     * @param  Verified $event
     *
     * @return void
     */
    public function handle(Verified $event): void
    {
        /** @var \App\Models\User */
        $user = $event->user;

        if (!$user->stripe_id) {
            $user->createOrGetStripeCustomer();
        }

        if ($promotion = Promotion::active()->signUps()->latest()->first()) {
            $promotion->trigger($event->user);
        }
    }
}
