<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Verified;

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

        if (!$user->wallet) {
            $user->wallet()->create();
        }
    }
}
