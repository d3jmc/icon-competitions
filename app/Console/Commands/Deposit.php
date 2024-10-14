<?php

namespace App\Console\Commands;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;

class Deposit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deposit {userId} {amount} {--description=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a deposit to a user`\s wallet with the specified amount.';

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
            $user->wallet->deposit($this->argument('amount'), $this->option('description') ?? 'Deposit made by the system');

            $this->info('The deposit has been made to the user\'s wallet');
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
