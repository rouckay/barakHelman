<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\markets>
 */
class MarketsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->realText(100),
            'lengthm_m2' => fake()->numberBetween(1233, 3211),
            'nomerah_number' => fake()->numberBetween(1, 100),
            'nomerah_owner' => fake()->numberBetween(1, 100),
            'owner_phone_number' => fake()->phoneNumber(),
        ];
    }
}
