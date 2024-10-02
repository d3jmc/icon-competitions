<?php

use App\Actions\Auth\Register;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new
#[Layout('layouts.auth')]
#[Title('Register for an account')]
class extends Component
{
    #[Validate('required|string')]
    public string $prefix = '';
    
    #[Validate('required|string')]
    public string $first_name = '';

    #[Validate('required|string')]
    public string $last_name = '';

    #[Validate('required|string|email|lowercase|unique:' . User::class)]
    public string $email = '';

    #[Validate('required|string|unique:' . User::class)]
    public string $mobile_number = '';

    #[Validate('required|string|confirmed')]
    public string $password = '';

    public string $password_confirmation = '';

    #[Validate('boolean')]
    public bool $terms = false;

    /**
     * @return void
     */
    public function register(): void
    {
        (new Register)->handle($this->validate());

        $this->redirectIntended(default: route('account', absolute: false), navigate: true);
    }
}
?>

<div class="flex flex-col gap-8">
    <x-page-header title="Create an account" subtitle="Manage your profile, enter competitions and claim prizes." />

    <x-errors />

    <form wire:submit="register" class="flex flex-col gap-4">
        <x-native-select wire:model="prefix" label="Title" placeholder="Please choose" :options="\App\Enums\Honorific::cases()" option-label="value" option-value="value" required />
        <x-input wire:model="first_name" type="text" label="First Name" required />
        <x-input wire:model="last_name" type="text" label="Last Name" required />
        <x-input wire:model="email" type="email" label="Email" required />
        <x-input wire:model="mobile_number" type="text" label="Mobile Number" required />
        <x-input wire:model="password" type="password" label="Password" required />
        <x-input wire:model="password_confirmation" type="password" label="Confirm Password" required />
        <x-checkbox wire:model="terms" label="I agree to the terms and conditions and privacy policy." required />
        <x-button type="submit" label="Register" lg primary spinner />
    </form>

    <div class="flex justify-center gap-4">
        @if (Route::has('login'))
            <x-link wire:navigate label="Already have an account?" href="{{ route('login') }}" class="!font-normal" />
        @endif
    </div>
</div>