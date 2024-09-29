<?php

use App\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('layouts.auth')]
#[Title('Verify your email')]
class extends Component
{
    /**
     * @return void
     */
    public function sendVerification(): void
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('account', absolute: false), navigate: true);
            return;
        }

        $user->sendEmailVerificationNotification();

        session()->flash('message', 'A new verification link has been sent to the email address you provided during registration.');
    }

    /**
     * @param Logout $logout
     * @return void
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}
?>

<div class="flex flex-col gap-8">
    <x-session-message :message="session('message')" />
 
    <x-page-header title="Verify your email" subtitle="Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another." />

    <x-button wire:click="sendVerification" type="button">Resend Verification Email</x-button>
    <x-button wire:click="logout" type="button">Logout</x-button>
</div>