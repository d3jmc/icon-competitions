<?php

use App\Actions\Auth\Login;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('layouts.auth')]
#[Title('Login to your account')]
class extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'boolean',
        ];
    }

    /**
     * @return void
     */
    public function login(): void
    {
        $this->validate();

        (new Login)->handle($this->email, $this->password, $this->remember);

        $this->redirectIntended(default: route('account', absolute: false), navigate: true);
    }
}
?>

<div class="flex flex-col gap-8">
    <x-page-header title="Log in" subtitle="Access your account." />

    <x-errors />

    <form wire:submit="login" class="flex flex-col gap-4">
        <x-input wire:model="email" type="email" label="Email" required />    
        <x-input wire:model="password" type="password" label="Password" required />
        <x-checkbox wire:model="remember" label="Remember me" />
        <x-button type="submit" label="Log in" lg primary spinner />
    </form>

    <div class="flex justify-center gap-4">
        @if (Route::has('password.request'))
            <x-link wire:navigate label="Forgot password?" href="{{ route('password.request') }}" class="!font-normal" />
        @endif

        @if (Route::has('register'))
            <x-link wire:navigate label="Create an account" href="{{ route('register') }}" class="!font-normal" />
        @endif
    </div>
</div>