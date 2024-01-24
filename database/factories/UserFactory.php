<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\Business;
use App\Models\Technician;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => $this->faker->randomElement([
                UserRole::Business,
                UserRole::Business,
                UserRole::Business,
                UserRole::Admin,
                UserRole::Technician
            ]),
            'direction_direction' => $this->faker->streetAddress,
            'direction_postal_code' => substr($this->faker->postcode, 0, 5),
            'direction_poblation' => $this->faker->city,
            'direction_country_id' => \App\Models\Country::all()->random()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            if ($user->role === UserRole::Business) {
                Business::factory()->create([
                    'id' => $user->id,
                    'contact_info_email' => $user->email,
                ]);
            }

            if ($user->role === UserRole::Technician) {
                Technician::factory()->create([
                    'id' => $user->id,
                ]);
            }
        });
    }
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
