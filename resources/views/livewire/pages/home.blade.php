<?php

use App\Models\Competition;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('layouts.app')]
#[Title('Home')]
class extends Component
{
    /**
     * @var Collection
     */
    public Collection $competitions;

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->competitions = Competition::query()
            ->active()
            ->withCount([
                'tickets',
                'tickets as instant_win_tickets_count' => fn ($query) => $query->instantWin(),
            ])
            ->orderBy('created_at', 'DESC')
            ->limit(3)
            ->get();
    }
}
?>

<div>
    <div class="relative h-[350px] bg-secondary overflow-hidden text-primary">
        <div class="relative h-full container">
            <div class="absolute top-[2rem] right-[16rem] w-[26rem] h-[26rem] bg-primary rounded-full z-0" style="background-position: 25% -83%; background-size: 90%; transform: translate(50%, -50%);"></div>
            <div class="absolute top-[2rem] right-[16rem] w-[22rem] h-[22rem] rounded-full border-[25px] border-secondary" style="transform: translate(50%, -50%);"></div>
            <div class="absolute top-[2rem] right-[16rem] w-[14rem] h-[14rem] rounded-full border-[25px] border-secondary" style="transform: translate(50%, -50%);"></div>
            <div class="flex max-w-[450px] h-full py-16">
                <div class="flex flex-col gap-4 mt-auto">
                    <h1 class="text-5xl xl:text-6xl">The best odds, <span class="font-bold">guaranteed.</span></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col gap-8 py-20 container">
        @if ($competitions)
            <x-page-header title="Latest Competitions" subtitle="Subtitle text goes here" />
            <div class="grid grid-cols-3 gap-20 mt-[35px]">
                @foreach ($competitions as $competition)
                    <x-competition-card :competition="$competition" />
                @endforeach
            </div>
        @endif
    </div>

</div>