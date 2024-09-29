<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
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
        $validated = $this->validate();

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirectIntended(default: route('account', absolute: false), navigate: true);
    }
}
?>

<div class="flex flex-col gap-8">
    <x-page-header title="Create an account" subtitle="Manage your profile, enter competitions and claim prizes." />

    <form wire:submit="register" class="flex flex-col gap-4">
        <div>
            <x-input-label for="prefix" value="Title" />
            <x-select wire:model.change="prefix" id="prefix" :options="\App\Enums\Honorific::cases()" required />
            <x-input-error :messages="$errors->get('prefix')" class="mt-2" />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="first_name" value="First Name" />
                <x-input wire:model="first_name" id="first_name" type="text" required />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="last_name" value="Last Name" />
                <x-input wire:model="last_name" id="last_name" type="text" required />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
        </div>
        <div>
            <x-input-label for="email" value="Email" />
            <x-input wire:model="email" id="email" type="email" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="mobile_number" value="Mobile Number" />
            <x-input wire:model="mobile_number" id="mobile_number" type="text" required />
            <x-input-error :messages="$errors->get('mobile_number')" class="mt-2" />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" value="Password" />
                <x-input wire:model="password" id="password" type="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="password_confirmation" value="Confirm Password" />
                <x-input wire:model="password_confirmation" id="password_confirmation" type="password" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>
        <div>
            <label for="terms" class="inline-flex items-center gap-2">
                <input wire:model="terms" id="terms" type="checkbox" class="w-auto" required />
                <span class="text-sm">I agree to the terms and conditions and privacy policy.</span>
            </label>
            <x-input-error :messages="$errors->get('terms')" class="mt-2" />
        </div>
        <x-button>Register</x-button>
    </form>

    <div class="flex justify-center gap-4">
        @if (Route::has('login'))
            <a href="{{ route('login') }}" wire:navigate>Already have an account?</a>
        @endif
    </div>
</div>