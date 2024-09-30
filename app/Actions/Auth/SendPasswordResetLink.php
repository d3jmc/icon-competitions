<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Password;

class SendPasswordResetLink
{
    /**
     * @var string
     */
    public string $status;

    /**
     * @param  string $email
     *
     * @return void
     */
    public function handle(string $email): void
    {
        $this->status = Password::sendResetLink(['email' => $email]);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}