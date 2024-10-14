<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Address;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->has(Address::factory())
            ->has(Wallet::factory())
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
            ->has(Wallet::factory())
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
    }
}
