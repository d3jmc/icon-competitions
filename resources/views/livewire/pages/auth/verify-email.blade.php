<?php

use App\Actions\Auth\Logout;
use App\Actions\Auth\SendVerification;
use Illuminate\Support\Facades\Auth;
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
        (new SendVerification)->handle(Auth::user());

        session()->flash('message', 'A new verification link has been sent to the email address you provided during registration');
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        (new Logout)->handle();
    }
}
?>

<div class="flex flex-col gap-8">
    @if (session('message'))
        <x-alert :title="session('message')" positive />
    @endif

    <x-page-header title="Verify your email" subtitle="Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another." />

    <x-button wire:click="sendVerification" label="Resend Verification Email" lg primary spinner />
    <x-button wire:click="logout" label="Logout" lg primary spinner />
</div>