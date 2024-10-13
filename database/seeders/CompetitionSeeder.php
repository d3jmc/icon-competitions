<?php

namespace Database\Seeders;

use App\Actions\GenerateTickets;
use App\Models\Competition;
use App\Models\Prize;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generateTickets = new GenerateTickets;

        Competition::factory()
            ->count(1)
            ->has(Prize::factory(3))
            ->create()
            ->each(fn(Competition $competition) => $generateTickets->handle($competition));
    }
}
