<?php

namespace Database\Factories;

use App\Enums\CompetitionStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Competition>
 */
class CompetitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(),
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
            'description' => fake()->paragraph(),
            'thumbnail' => 'https://lancashirecompetitions.com/wp-content/uploads/2024/11/IMG_7077.jpg',
            'start_date' => now()->addHour(),
            'end_date' => now()->addDay(14),
            'ticket_price' => fake()->randomFloat(2, 0, 2),
            'min_tickets' => 1,
            'max_tickets' => fake()->numberBetween(10000, 100000),
            'min_tickets_per_user' => 1,
            'max_tickets_per_user' => -1,
            'instant_wins' => function (array $attributes) {
                return fake()->numberBetween(1, ($attributes['max_tickets'] / 2));
            },
            'status' => CompetitionStatus::ACTIVE,
        ];
    }
}
