<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use SensitiveParameter;

class Login
{
    /**
     * @param  string $email
     * @param  string $password
     * @param  bool   $remember
     *
     * @return void
     */
    public function handle(string $email, #[SensitiveParameter] string $password, bool $remember = false): void
    {
        if (!Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        Session::regenerate();
    }
}