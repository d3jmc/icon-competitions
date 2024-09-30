<?php

use App\Actions\Auth\SendPasswordResetLink;
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

        $action = new SendPasswordResetLink();
        $action->handle($this->email);

        $status = $action->getStatus();

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
    
    @if (session('message'))
        <x-alert :title="session('message')" positive />
    @endif

    <x-errors />
    
    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-4">
        <x-input wire:model="email" type="email" label="Email" required />
        <x-button type="submit" label="Email password reset link" />
    </form>
</div>