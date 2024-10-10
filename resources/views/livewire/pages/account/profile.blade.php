<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('layouts.account')]
#[Title('My Profile')]
class extends Component
{
    public User $user;

    public string $prefix = '';

    public string $first_name = '';

    public string $last_name = '';

    public string $email = '';

    public string $mobile_number = '';

    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'prefix' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|lowercase|unique:' . User::class . ',email,' . $this->user->id,
            'mobile_number' => 'required|string|unique:' . User::class . ',mobile_number,' . $this->user->id,
        ];
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->user = Auth::user();

        $this->prefix = $this->user->prefix->value;
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->email = $this->user->email;
        $this->mobile_number = $this->user->mobile_number;
    }

    /**
     * @return void
     */
    public function save(): void
    {
        $validated = $this->validate();

        $this->user->update($validated);

        session()->flash('message', 'Your profile has been saved successfully.');
    }
}
?>

<div class="space-y-8">
    <x-page-header title="Your profile" subtitle="View and edit your profile information." />

    <x-errors />

    @if (session('message'))
        <x-alert :title="session('message')" positive />
    @endif

    <form wire:submit="save" class="flex flex-col gap-4 w-1/2">
        <x-native-select wire:model="prefix" label="Title" placeholder="Please choose" :options="\App\Enums\Honorific::cases()" option-label="value" option-value="value" required />
        <div class="grid grid-cols-2 gap-4">
            <x-input wire:model="first_name" type="text" label="First Name" required />
            <x-input wire:model="last_name" type="text" label="Last Name" required />
            <x-input wire:model="email" type="email" label="Email" required />
            <x-input wire:model="mobile_number" type="text" label="Mobile Number" required />
        </div>
        <div class="text-end">
            <x-button type="submit" label="Save" lg primary spinner />
        </div>
    </form>
</div>