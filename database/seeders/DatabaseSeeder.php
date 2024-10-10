<?php

namespace Database\Seeders;

use App\Actions\GenerateTickets;
use App\Enums\UserRole;
use App\Models\Address;
use App\Models\Competition;
use App\Models\Prize;
use App\Models\Promotion;
use App\Models\PromotionAction;
use App\Models\User;
use App\Promotions\ApplyCredit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @var GenerateTickets
     */
    protected GenerateTickets $generateTickets;

    public function __construct()
    {
        $this->generateTickets = new GenerateTickets;
    }

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
        
        User::factory()
            ->has(Address::factory())
            ->create([
                'role' => UserRole::SUPER_ADMIN,
                'prefix' => 'Mr',
                'first_name' => 'Dom',
                'last_name' => 'McLaughlin',
                'email' => 'dom@d3j.digital',
                'email_verified_at' => now(),
                'mobile_number' => '+4407123456789',
                'password' => 'password',
                'stripe_id' => 'cus_QuQY7wE8T5TmGp',
            ]);

        User::factory()
            ->has(Address::factory())
            ->create([
                'role' => UserRole::MEMBER,
                'prefix' => 'Mr',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@test.com',
                'email_verified_at' => now(),
                'mobile_number' => '+4407987654321',
                'password' => 'password',
                'stripe_id' => 'cus_QuQY5bTiUtn92x',
            ]);

        Promotion::factory()
            ->has(PromotionAction::factory(), 'actions')
            ->create();
            
        // Competition::factory()
        //     ->count(1)
        //     ->has(Prize::factory(3))
        //     ->create()
        //     ->each(fn(Competition $competition) => $this->generateTickets->handle($competition));
    }
}
