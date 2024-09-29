<?php

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

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $this->only('email', 'password', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => $this->password,
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
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

    <form wire:submit="resetPassword" class="flex flex-col gap-4">
        <div>
            <x-input-label for="email" value="Email" />
            <x-input wire:model="email" id="email" type="email" disabled readonly required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
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
        <x-button>Reset Password</x-button>
    </form>
</div>