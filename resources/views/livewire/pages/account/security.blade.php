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

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'password' => 'required|string|confirmed',
        ];
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->user = Auth::user();
    }

    /**
     * @return void
     */
    public function changePassword(): void
    {
        $validated = $this->validate();

        $this->user->update($validated);

        session()->flash('message', 'Your password has been changed successfully.');
    }
}
?>

<div class="space-y-8">
    <x-page-header title="Change your password" subtitle="Please enter your new password below." />

    <x-errors />

    @if (session('message'))
        <x-alert :title="session('message')" positive />
    @endif

    <form wire:submit="changePassword" class="flex flex-col gap-4 w-1/2">
        <x-input wire:model="password" type="password" label="Password" required />
        <x-input wire:model="password_confirmation" type="password" label="Confirm Password" required />
        <div class="text-end">
            <x-button type="submit" label="Save" lg primary spinner />
        </div>
    </form>
</div>