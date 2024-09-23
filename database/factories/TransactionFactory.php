<?php

namespace Database\Factories;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => TransactionType::DEPOSIT,
            'amount' => fake()->numberBetween(1, 10),
            'description' => fake()->sentence(),
            'actioned_by' => 'SYSTEM',
            'status' => TransactionStatus::COMPLETE,
        ];
    }
}
