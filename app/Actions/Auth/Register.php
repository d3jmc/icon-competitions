<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class Register
{
    /**
     * @param  array $attributes
     *
     * @return void
     */
    public function handle(array $attributes): void
    {
        event(new Registered($user = User::create($attributes)));

        Auth::login($user);
    }
}