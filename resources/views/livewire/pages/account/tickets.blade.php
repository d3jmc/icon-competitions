<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('layouts.account')]
#[Title('My Tickets')]
class extends Component
{
    /**
     * @var User
     */
    public User $user;

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->user = Auth::user();
    }
}
?>

<div class="space-y-8">
    <x-page-header title="My Tickets" subtitle="View the tickets you have purchased here." />
</div>