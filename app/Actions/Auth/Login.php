<?php

namespace App\Actions\Auth;

use App\Models\User;
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
        if (Auth::attempt([
            'email' => $email,
            'password' => $password,
        ], $remember)) {

            /** @var User */
            $user = Auth::user();

            $user->update([
                'last_login_at' => now(),
                'last_login_ip' => request()->ip(),
            ]);
        } else {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        Session::regenerate();
    }
}