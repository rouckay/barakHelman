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
            'numera_price' => fake()->numberBetween(52343, 934234),
            'sharwali_tarifa_price' => fake()->numberBetween(2000, 3000),
            'Customer_image' => fake()->name(),
            'documents' => fake()->name(),
        ];
    }
}
