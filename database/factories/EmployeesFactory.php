<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\employees>
 */
class EmployeesFactory extends Factory
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
            'lastName' => fake()->name(),
            'FatherName' => fake()->name(),
            'Position' => fake()->jobTitle(),
            'Education' => fake()->jobTitle(),
            'salary' => fake()->numberBetween(1000, 20000),
            'tazkira' => fake()->numberBetween(13123, 123122),
            'date_of_contract' => fake()->date(),
            'end_date_of_contract' => fake()->date(),
            'phone_number' => fake()->phoneNumber(),
            'Address' => fake()->address(),
        ];
    }
}
