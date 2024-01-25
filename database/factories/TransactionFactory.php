<?php

namespace Database\Factories;

use App\Enums\FinalizeReason;
use App\Enums\TransactionStateType;
use App\Models\Business;
use App\Models\Payment;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'concept' => fake()->sentence(),
            'amount' => random_int(10, 100),
            'state' => TransactionStateType::Waiting,
            'receipt_number' => fake()->randomLetter() . fake()->randomNumber(),
            'emision_date' => Carbon::now(),
        ];
    }

    public function withEmissionDate(?Carbon $date): TransactionFactory
    {
        return $this->state(function (array $attributes) use ($date) {
            return [
                'emision_date' => $date,
            ];
        });
    }

    public function withAmount(float $amount): TransactionFactory
    {
        return $this->state(function (array $attributes) use ($amount) {
            return [
                'amount' => $amount,
            ];
        });
    }

    public function withFinalizeReason(FinalizeReason $reason): TransactionFactory
    {
        return $this->state(function (array $attributes) use ($reason) {
            return [
                'state' => $reason->getReasonState(),
                'finalize_reason' => $reason,
                'finished_date' => Carbon::now(),
            ];
        });
    }

    public function withFinalizedDate(?Carbon $date): TransactionFactory
    {
        return $this->state(function (array $attributes) use ($date) {
            return [
                'finished_date' => $date,
            ];
        });
    }

    public function withPaymentInformation(?Payment $payment): TransactionFactory
    {
        return $this->state(function (array $attributes) use ($payment) {
            return [
                'payment_id' => $payment ? $payment->id : Payment::factory()->create()->id
            ];
        });
    }

    public function withBusiness(?Business $business): TransactionFactory
    {
        return $this->state(function (array $attributes) use ($business) {
            return [
                'business_id' => $business ? $business->id : Business::factory()->create()->id
            ];
        });
    }

    public function refounds(?Transaction $transaction): TransactionFactory
    {
        return $this->state(function (array $attributes) use ($transaction) {
            return [
                'refounds_id' => $transaction ? $transaction->id : Transaction::factory()
                    ->withAmount($attributes['amount'])
                    ->withFinalizeReason(FinalizeReason::OK)
                    ->withEmissionDate($attributes['emision_date'])
                    ->withFinalizedDate($attributes['emision_date'])
                    ->create([
                        'business_id' => $attributes['business_id'],
                        'payment_id' => $attributes['payment_id'],
                    ])->id,
                'amount' => $attributes['amount'] * -1,
            ];
        });
    }
}
