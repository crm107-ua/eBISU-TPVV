<?php

namespace Database\Seeders;

use App\Enums\FinalizeReason;
use App\Models\Business;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Transaction::truncate();
        $finalizeReasons = [
            null, null,
            FinalizeReason::OK, FinalizeReason::OK, FinalizeReason::OK,
            FinalizeReason::INSUFFICIENT_BALANCE,
            FinalizeReason::TIMEOUT,
            FinalizeReason::INVALID_PAYMENT_INFORMATION,
            FinalizeReason::CANCELLED,
        ];

        $businesses = Business::all();
        if (count($businesses) === 0)
            return;

        for ($i = 0; $i < random_int(100, 10000); $i++) {
            $business = fake()->randomElement($businesses);
            $finalizeReason = fake()->randomElement($finalizeReasons);
            $amount = random_int(10, 1000);
            $emittedXDaysAgo = random_int(1, 365);

            $tFactory = Transaction::factory()
                ->withEmissionDate(Carbon::now()->subDays($emittedXDaysAgo))
                ->withBusiness($business)
                ->withAmount($amount);
            if (!$finalizeReason) {
                $tFactory->create();
                continue;
            }
            $tFactory = $tFactory->withFinalizeReason($finalizeReason);
            $tFactory = $tFactory->withFinalizedDate(Carbon::now()->subDays(random_int(0, $emittedXDaysAgo)));
            if ($finalizeReason->hasAssociatedPaymentMethod())
                $tFactory = $tFactory->withPaymentInformation(null); // crear metodo de pago ahora

            $isRefound = $finalizeReason == FinalizeReason::OK && random_int(0, 100) <= 5;
            if ($isRefound) {
                $tFactory = $tFactory->refounds(null); // crear transacicon a devolver ahora
            } else {
                $business->balance += $amount;
            }
            $tFactory->create();
        }

        foreach ($businesses as $business) {
            $business->save();
        }
    }
}
