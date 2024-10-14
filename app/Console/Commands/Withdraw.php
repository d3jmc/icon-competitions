<?php

namespace App\Console\Commands;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;

class Withdraw extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:withdraw {userId} {amount} {--description=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a withdrawal from a user`\s wallet with the specified amount.';

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
            $user->wallet->withdraw($this->argument('amount'), $this->option('description') ?? 'Withdrawal made by the system');

            $this->info('The withdrawl has been made from the user\'s balance.');
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
