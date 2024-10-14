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
    protected $signature = 'app:start-competition {--ids=?}';

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
        $ids = $this->option('ids') ? explode(',', $this->option('ids')) : [];

        Competition::query()
            ->when(!empty($ids), function ($query) use ($ids) {
                return $query->whereIn('id', $ids);
            })
            ->scheduled()
            ->pastStartDate()
            ->get()
            ->each(fn (Competition $competition) => dispatch(new StartCompetition($competition)));
    }
}
