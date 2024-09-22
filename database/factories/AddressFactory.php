<?php

namespace Database\Factories;

use App\Enums\AddressType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => AddressType::PRIMARY,
            'line_1' => fake()->streetAddress(),
            'city' => fake()->city(),
            'region' => fake()->state(),
            'postcode' => fake()->postcode(),
            'country' => fake()->country(),
        ];
    }
}
