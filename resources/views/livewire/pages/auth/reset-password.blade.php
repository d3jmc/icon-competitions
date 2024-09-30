<?php

use App\Actions\Auth\ResetPassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new
#[Layout('layouts.auth')]
#[Title('Reset Password')]
class extends Component
{
    #[Locked]
    public string $token = '';

    #[Validate('required|string|email')]
    public string $email = '';
    
    #[Validate('required|string|confirmed')]
    public string $password = '';

    public string $password_confirmation = '';

    /**
     * @param string $token
     * @return void
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * @return void
     */
    public function resetPassword(): void
    {
        $this->validate();

        $action = new ResetPassword();
        $action->handle($this->email, $this->password, $this->token);

        $status = $action->getStatus();

        if ($status !== Password::PASSWORD_RESET) {
            $this->addError('email', __($status));
            return;
        }

        session()->flash('message', __($status));

        $this->redirectRoute('login', navigate: true);
    }
}
?>

<div class="flex flex-col gap-8">
    <x-page-header title="Reset Password" subtitle="Fill in the fields below to reset your password." />

    @if (session('message'))
        <x-alert :title="session('message')" positive />
    @endif

    <x-errors />

    <form wire:submit="resetPassword" class="flex flex-col gap-4">
        <x-input wire:model="email" type="email" label="Email" disabled readonly required />
        <x-input wire:model="password" type="password" label="Password" required />
        <x-input wire:model="password_confirmation" type="password" label="Confirm Password" required />
        <x-button type="submit" label="Reset password" />
    </form>
</div>