<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        $transactions = [
            [
                'concept' => 'Service Payment',
                'amount' => 100.50,
                'state' => 'waiting',
                'receipt_number' => 'RPP123411',
                'emision_date' => Carbon::now()->subMonth(4),
                'finished_date' => null,
                'finalize_reason' => 0,
                'refounds_id' => null,
                'business_id' => 3,
                'payment_id' => 1,
            ],
            [
                'concept' => 'Product Purchase',
                'amount' => 250.00,
                'state' => 'accepted',
                'receipt_number' => 'RX1234229',
                'emision_date' => Carbon::now()->subDay(22),
                'finished_date' => Carbon::now(),
                'finalize_reason' => 0,
                'refounds_id' => null,
                'business_id' => 4,
                'payment_id' => 2,
            ],
            [
                'concept' => 'Box Purchase',
                'amount' => 300.00,
                'state' => 'cancelled',
                'receipt_number' => 'RX1134761',
                'emision_date' => Carbon::now()->subMonth(7),
                'finished_date' => Carbon::now(),
                'finalize_reason' => 1,
                'refounds_id' => null,
                'business_id' => 4,
                'payment_id' => 2,
            ],
            [
                'concept' => 'House Purchase',
                'amount' => 1000.00,
                'state' => 'cancelled',
                'receipt_number' => 'RWW134761',
                'emision_date' => Carbon::now()->subMonth(9),
                'finished_date' => Carbon::now(),
                'finalize_reason' => 3,
                'refounds_id' => null,
                'business_id' => 3,
                'payment_id' => 1,
            ],
            [
                'concept' => 'Kibab Purchase',
                'amount' => 1000.00,
                'state' => 'cancelled',
                'receipt_number' => 'RXZZ23449',
                'emision_date' => Carbon::now()->subDay(10),
                'finished_date' => Carbon::now(),
                'finalize_reason' => 2,
                'refounds_id' => 3,
                'business_id' => 4,
                'payment_id' => 2,
            ],
            [
                'concept' => 'Service Payment 432234',
                'amount' => 100.50,
                'state' => 'waiting',
                'receipt_number' => 'RPP143343411',
                'emision_date' => Carbon::now()->subMonth(1),
                'finished_date' => null,
                'finalize_reason' => 0,
                'refounds_id' => null,
                'business_id' => 3,
                'payment_id' => 1,
            ],
            [
                'concept' => 'Service Payment 442334',
                'amount' => 100.50,
                'state' => 'waiting',
                'receipt_number' => 'RPP143343411',
                'emision_date' => Carbon::now(),
                'finished_date' => null,
                'finalize_reason' => 0,
                'refounds_id' => null,
                'business_id' => 6,
                'payment_id' => 15,
            ],
            [
                'concept' => 'Service Payment 234423',
                'amount' => 100.50,
                'state' => 'waiting',
                'receipt_number' => 'RPP143343411',
                'emision_date' => Carbon::now()->subDay(8),
                'finished_date' => null,
                'finalize_reason' => 0,
                'refounds_id' => null,
                'business_id' => 6,
                'payment_id' => 14,
            ]
        ];

        // Insert transactions into the database
        foreach ($transactions as $transaction) {
            DB::table('transactions')->insert($transaction);
        }
    }
}
