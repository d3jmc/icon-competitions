<?php

use App\Actions\Auth\Register;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('layouts.auth')]
#[Title('Register for an account')]
class extends Component
{
    public string $prefix = '';
    
    public string $first_name = '';

    public string $last_name = '';

    public string $email = '';

    public string $mobile_number = '';

    public string $password = '';

    public string $password_confirmation = '';

    public bool $terms = false;

    protected function rules(): array
    {
        return [
            'prefix' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|lowercase|unique:' . User::class,
            'mobile_number' => 'required|string|unique:' . User::class,
            'password' => 'required|string|confirmed',
            'terms' => 'accepted',
        ];
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $validated = $this->validate();

        (new Register)->handle($validated);

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