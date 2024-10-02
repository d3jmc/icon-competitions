<?php

namespace App\Console\Commands;

use App\Jobs\EndCompetition;
use App\Models\Competition;
use Illuminate\Console\Command;

class EndCompetitions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'competition:end {--ids=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'End competitions from a comma-separated string or those that are ready.';

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
            ->active()
            ->pastEndDate()
            ->get()
            ->each(fn (Competition $competition) => dispatch(new EndCompetition($competition)));
    }
}
