<?php

namespace App\Console\Commands;

use App\Actions\PurchaseTickets as Action;
use App\Models\Competition;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;

class PurchaseTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'competition:purchase-tickets {competition} {amount} {user} {--charge}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purchase tickets on behalf of a user for a competition.';

    /**
     * Execute the console command.
     * 
     * @return void
     */
    public function handle(): void
    {
        $competition = Competition::findOrFail($this->argument('competition'));

        $amount = $this->argument('amount');

        if ($amount <= 0) {
            $this->error('The amount of tickets must be greater than 0.');
            return;
        }

        $user = User::findOrFail($this->argument('user'));

        if (!$charge = $this->option('charge')) {
            $this->info('No charge option was selected. Skipping payment.');
        }

        try {
            (new Action)->handle($user, $competition, $amount, $charge);

            $this->info("$amount tickets purchased for {$user->fullName} in the {$competition->name} competition.");
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
