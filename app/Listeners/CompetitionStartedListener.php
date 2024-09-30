<?php

namespace App\Listeners;

use App\Events\CompetitionStarted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CompetitionStartedListener
{
    /**
     * @param  CompetitionStarted $event
     *
     * @return void
     */
    public function handle(CompetitionStarted $event): void
    {
        Log::info('competition started', $event->competition->toArray());
    }
}
