<?php

namespace App\Console\Commands;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;

class CreditBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:debit-balance {userId} {amount} {--description=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Debit a user`\s Stripe balance with the specified amount.';

    /**
     * Execute the console command.
     * 
     * @return void
     */
    public function handle(): void
    {
        /** @var User */
        $user = User::findOrFail($this->argument('userId'));
        
        try {
            $user->debitBalance((int) ($this->argument('amount') * 100), $this->option('description') ?? 'Balance debited by the system');

            $this->info('The user\'s balance has been debited successfully.');
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
