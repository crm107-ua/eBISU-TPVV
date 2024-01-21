<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ApiToken>
 */
class ApiTokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'issuer' => 'ApiToken Factory',
            'expiration_date' => now()->addHour(),
        ];
    }

    public function expired(): ApiTokenFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'expiration_date' => now()->subDays(1),
            ];
        });
    }

    public function invalidated(): ApiTokenFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'invalidated' => true,
            ];
        });
    }
}
