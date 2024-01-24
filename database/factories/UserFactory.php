<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\Business;
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
            'role' => $this->faker->randomElement([UserRole::Admin, UserRole::Business, UserRole::Technician]),
            'direction_direction' => $this->faker->streetAddress,
            'direction_postal_code' => substr($this->faker->postcode, 0, 5),
            'direction_poblation' => $this->faker->city,
            'direction_country_id' => \App\Models\Country::all()->random()->id,
        ];
    }

    public function withBusiness(): Factory
    {
        return $this->afterCreating(function (User $user) {
            $businessData = [
                'cif' => $this->faker->regexify('[A-Z]\d{8}'),
                'registration_date' => now(),
                'balance' => $this->faker->randomFloat(2, 0, 5000),
                'contact_info_name' => $this->faker->name(),
                'contact_info_phone_number' => $this->faker->phoneNumber(),
                'contact_info_email' => $user->email,
            ];
            Business::factory()->state($businessData)->create(['id' => $user->id]);
        });
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $user->business()->save(Business::factory()->make());
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
