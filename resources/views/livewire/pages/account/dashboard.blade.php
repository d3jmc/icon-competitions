<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('layouts.account')]
#[Title('My Account')]
class extends Component
{
    /**
     * @var User
     */
    public User $user;

    /**
     * @var array
     */
    public array $stats = [];

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->user = Auth::user();
        
        $this->stats = [
            [
                'title' => 'Joined',
                'value' => $this->user->created_at->diffForHumans(),
            ],
            [
                'title' => 'Last Logged In',
                'value' => $this->user->last_login_at ?? 'Unknown',
            ],
            [
                'title' => 'Wallet Balance',
                'value' => '£' . $this->user->wallet->balance ?? 0,
            ],
            [
                'title' => 'Competitions Entered',
                'value' => $this->user->competitions()->count(),
            ],
            [
                'title' => 'Last Competition Entered',
                'value' => $this->user->latestCompetition()->name ?? 'Unknown',
            ],
            [
                'title' => 'Tickets Purchased',
                'value' => $this->user->tickets()->count(),
            ],
            [
                'title' => 'Last Ticket Purchased',
                'value' => $this->user->latestTicket()->claimed_on ?? 'Unknown',
            ],
            [
                'title' => 'Instant Wins',
                'value' => $this->user->instantWins()->count(),
            ],
            [
                'title' => 'Last Instant Win',
                'value' => $this->user->latestInstantWin()?->prize->name ?? 'Unknown',
            ],
        ];
    }
}
?>

<div class="space-y-8">
    <x-page-header title="Welcome, {{ $user->fullName }}" subtitle="Here's a quick overview of your account." />

    <div class="grid grid-cols-3 gap-8">
        @foreach ($stats as $stat)
            <div class="bg-white border rounded-lg p-4">
                <h3 class="text font-medium">{{ $stat['title'] }}</h3>
                <p class="text-gray-500">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>
</div>