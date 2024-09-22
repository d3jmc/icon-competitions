<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'role' => UserRole::SUPER_ADMIN,
            'prefix' => 'Mr',
            'first_name' => 'Dom',
            'last_name' => 'McLaughlin',
            'email' => 'dom@d3j.digital',
            'email_verified_at' => now(),
            'mobile_number' => '+4407123456789',
            'password' => 'password',
        ]);

        User::factory()->create([
            'role' => UserRole::MEMBER,
            'prefix' => 'Mr',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@test.com',
            'email_verified_at' => now(),
            'mobile_number' => '+4407987654321',
            'password' => 'password',
        ]);
    }
}
