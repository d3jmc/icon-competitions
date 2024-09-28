<?php

namespace App\Console\Commands;

use App\Jobs\StartCompetition;
use App\Models\Competition;
use Illuminate\Console\Command;

class StartCompetitions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'competition:start {ids?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start competitions from a comma-separated string or those that are ready.';

    /**
     * Execute the console command.
     * 
     * @return void
     */
    public function handle(): void
    {
        $query = Competition::scheduled()->where('start_date', '<=', now());

        if ($ids = explode(',', $this->argument('ids'))) {
            $query->whereIn('id', $ids);
        }

        $competitions = $query->with('count')->get();
        $count = $competitions->count();

        if ($count > 0) {
            foreach ($competitions as $competition) {
                dispatch(new StartCompetition($competition));
            }

            $this->info("Starting {$count} competitions.");

            return;
        }

        $this->error('There are no competitions ready to start.');
    }
}
