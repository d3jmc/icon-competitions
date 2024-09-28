<?php

namespace App\Listeners;

use App\Events\CompetitionEnded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CompetitionEndedListener
{
    /**
     * Handle the event.
     */
    public function handle(CompetitionEnded $event): void
    {
        Log::info('competition ended', $event->competition->toArray());
    }
}
