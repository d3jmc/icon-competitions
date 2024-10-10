<?php

use App\Models\Competition;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new
#[Layout('layouts.app')]
class extends Component
{
    /**
     * @var Competition
     */
    public Competition $competition;

    /**
     * @param  Competition $competition
     *
     * @return void
     */
    public function mount(Competition $competition): void
    {
        if (!$competition->isActive()) {
            abort(404);
        }
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.pages.competition.show')
            ->title($this->competition->name);
    }
}
?>

<div>
    hello world
</div>