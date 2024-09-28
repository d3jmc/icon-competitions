<?php

namespace App\Jobs;

use App\Models\Competition;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;

class EndCompetition implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Competition $competition,
    ) {}

    /**
     * Execute the job.
     * 
     * @return void
     */
    public function handle(): void
    {
        $this->competition->end();
    }
}
