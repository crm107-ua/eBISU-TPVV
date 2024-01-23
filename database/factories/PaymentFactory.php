<?php

namespace Database\Factories;

use App\Enums\PaymentType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [PaymentType::Paypal, PaymentType::CreditCard];
        $type = $types[array_rand($types)];
        if ($type === PaymentType::Paypal) {
            return [
                'type' => PaymentType::Paypal,
                'paypal_user' => fake()->name(),
            ];
        } else {
            $expiration = Carbon::parse(fake()->creditCardExpirationDate());
            return [
                'type' => PaymentType::CreditCard,
                'credit_card_number' => fake()->creditCardNumber(),
                'credit_card_month_of_expiration' => $expiration->month,
                'credit_card_year_of_expiration' => $expiration->year,
                'credit_card_csv' => random_int(0, 999),
            ];
        }
    }
}
