<?php

namespace Database\Factories;

use App\Enums\TicketType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prize>
 */
class PrizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                '£5 instant cash',
                '£10 instant cash',
                '£100 instant cash',
            ]),
            'available' => fake()->numberBetween(1, 10),
            'assign_to_ticket_type' => TicketType::INSTANT_WIN,
        ];
    }
}
