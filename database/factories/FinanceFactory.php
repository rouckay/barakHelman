<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Finance>
 */
class FinanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->realText(100),
            'quantity' => fake()->numberBetween(1, 4000),
            'unit' => fake()->numberBetween(1, 100),
            'dollor' => fake()->numberBetween(1, 1000),
            'total_price' => fake()->numberBetween(40010, 2000000),
            'dollor_unit' => fake()->numberBetween(72, 80),
            'dollor_total' => fake()->numberBetween(41, 2000),
            'phone_number' => fake()->numberBetween(74333333, 79333333),
            'user_id' => 1,
        ];
    }
}
