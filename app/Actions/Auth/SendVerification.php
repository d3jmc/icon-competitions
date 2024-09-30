<?php

namespace App\Actions\Auth;

use App\Models\User;

class SendVerification
{
    /**
     * @param  User $user
     *
     * @return void
     */
    public function handle(User $user): void
    {
        if ($user->hasVerifiedEmail()) {
            return;
        }

        $user->sendEmailVerificationNotification();
    }
}