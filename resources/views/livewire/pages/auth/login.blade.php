<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new
#[Layout('layouts.auth')]
#[Title('Login to your account')]
class extends Component
{
    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    #[Validate('boolean')]
    public bool $remember = false;

    /**
     * @return void
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt($this->only(['email', 'password']), $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        Session::regenerate();

        $this->redirectIntended(default: route('account', absolute: false), navigate: true);
    }

    /**
     * @return void
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * @return string
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}
?>

<div class="flex flex-col gap-8">
    <x-page-header title="Log in" subtitle="Access your profile." />

    <form wire:submit="login" class="flex flex-col gap-4">
        <div>
            <x-input wire:model="email" id="email" type="email" :placeholder="__('Email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div>
            <x-input wire:model="password" id="password" type="password" :placeholder="__('Password')" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div>
            <label for="remember" class="inline-flex items-center gap-2">
                <input wire:model="remember" id="remember" type="checkbox" class="w-auto" />
                <span class="text-sm">{{ __('Remember me') }}</span>
            </label>
        </div>
        <x-button>{{ __('Log in') }}</x-button>
    </form>

    <div class="flex justify-center gap-4">
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" wire:navigate>{{ __('Forgot password?') }}</a>
        @endif

        @if (Route::has('register'))
            <a href="{{ route('register') }}" wire:navigate>{{ __('Create an account') }}</a>
        @endif
    </div>
</div>