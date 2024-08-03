<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\customers>
 */
class CustomersFactory extends Factory
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
            'father_name' => fake()->name(),
            'grand_father_name' => fake()->name(),
            'province' => fake()->city(),
            'village' => fake()->city(),
            'tazkira' => fake()->numberBetween(72342212, 78983333),
            'mobile_number' => fake()->phoneNumber(),
            'parmanent_address' => fake()->address(),
            'current_address' => fake()->address(),
            'numeraha_id' => 1,
            'payed_price' => fake()->numberBetween(2000, 50000),
            'due_price' => fake()->numberBetween(4000, 30000),
            'total_price' => fake()->numberBetween(2000, 50000),
            'job' => fake()->jobTitle(),
        ];
    }
}
