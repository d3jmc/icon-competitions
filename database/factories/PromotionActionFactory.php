<?php

namespace Database\Factories;

use App\Promotions\ApplyCredit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PromotionAction>
 */
class PromotionActionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'namespace' => ApplyCredit::class,
            'value' => 1,
        ];
    }
}
