<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        abort_if(
            boolean: !in_array(app()->environment(), ['local', 'testing']),
            code: 418,
            message: 'Never gonna let you down.',
        );
    
        $this->call([
            UserSeeder::class,
            // CompetitionSeeder::class,
        ]);
    }
}
