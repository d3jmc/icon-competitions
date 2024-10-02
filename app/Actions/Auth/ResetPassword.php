<?php

namespace App\Actions\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use SensitiveParameter;

class ResetPassword
{
    /**
     * @var string
     */
    public string $status;

    /**
     * @param  string $email
     * @param  string $password
     * @param  string $token
     *
     * @return void
     */
    public function handle(string $email, #[SensitiveParameter] string $password, string $token): void
    {
        $this->status = Password::reset([
                'email' => $email,
                'password' => $password,
                'password_confirmation' => $password,
                'token' => $token,
            ],
            function ($user) use ($password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}