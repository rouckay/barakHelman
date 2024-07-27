<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\numeraha>
 */
class NumerahaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero_number' => fake()->name(),
            'save_number' => fake()->numberBetween(121, 4321),
            'date' => fake()->date(),
            'tarifa_no' => fake()->numberBetween(52343, 934234),
            'transfered_money_to_bank' => fake()->numberBetween(20000, 30000),
            'Customer_image' => fake()->name(),
            'documents' => fake()->name(),
            'customer_id' => 1
        ];
    }
}
