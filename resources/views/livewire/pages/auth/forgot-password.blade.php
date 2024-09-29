<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new
#[Layout('layouts.auth')]
#[Title('Forgot Password')]
class extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';

    /**
     * @return void
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate();

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink($this->only('email'));

        if ($status !== Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));
            return;
        }

        $this->reset('email');

        session()->flash('message', __($status));
    }
}
?>

<div class="flex flex-col gap-8">
    <x-page-header title="Forgot Password" subtitle="Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one." />
    
    <x-session-message :message="session('message')" />
    
    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-4">
        <div>
            <x-input-label for="email" :value="'Email'" />
            <x-input wire:model="email" id="email" type="email" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <x-button>{{ 'Email Password Reset Link' }}</x-button>
    </form>
</div>