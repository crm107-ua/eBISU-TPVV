<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cif' => fake()->unique()->regexify('[A-Z]\d{8}'),
            'registration_date' => fake()->dateTimeBetween('-5 year', 'now'),
            'balance' => fake()->numberBetween(0, 5000),
            'contact_info_email' => fake()->email(),
            'contact_info_name' => fake()->name(),
            'contact_info_phone_number' => fake()->phoneNumber(),
        ];
    }
}
