<?php

namespace Database\Factories;

use App\Enums\PromotionStatus;
use App\Enums\PromotionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotion>
 */
class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => PromotionType::SIGN_UP,
            'name' => 'Sign up bonus',
            'description' => 'Sign up bonus for new users',
            'from' => now(),
            'to' => now()->addDays(7),
            'status' => PromotionStatus::ACTIVE,
        ];
    }
}
