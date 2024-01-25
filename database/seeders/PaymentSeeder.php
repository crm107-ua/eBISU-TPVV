<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Payment::truncate();

        $payments = [
            [
                'type' => 'credit_card',
                'paypal_user' => null,
                'credit_card_number' => '1234567890123456',
                'credit_card_month_of_expiration' => '12',
                'credit_card_year_of_expiration' => '2025',
                'credit_card_csv' => '123',
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'type' => 'credit_card',
                'paypal_user' => null,
                'credit_card_number' => '1224567770121116',
                'credit_card_month_of_expiration' => '12',
                'credit_card_year_of_expiration' => '2025',
                'credit_card_csv' => '123',
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'type' => 'paypal',
                'paypal_user' => 'user@example.com',
                'credit_card_number' => null,
                'credit_card_month_of_expiration' => null,
                'credit_card_year_of_expiration' => null,
                'credit_card_csv' => null,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'type' => 'paypal',
                'paypal_user' => 'user2@example.com',
                'credit_card_number' => null,
                'credit_card_month_of_expiration' => null,
                'credit_card_year_of_expiration' => null,
                'credit_card_csv' => null,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'type' => 'paypal',
                'paypal_user' => 'user111@example.com',
                'credit_card_number' => null,
                'credit_card_month_of_expiration' => null,
                'credit_card_year_of_expiration' => null,
                'credit_card_csv' => null,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'type' => 'paypal',
                'paypal_user' => 'user22222@example.com',
                'credit_card_number' => null,
                'credit_card_month_of_expiration' => null,
                'credit_card_year_of_expiration' => null,
                'credit_card_csv' => null,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'type' => 'paypal',
                'paypal_user' => 'user12312@example.com',
                'credit_card_number' => null,
                'credit_card_month_of_expiration' => null,
                'credit_card_year_of_expiration' => null,
                'credit_card_csv' => null,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'type' => 'paypal',
                'paypal_user' => 'user2123312@example.com',
                'credit_card_number' => null,
                'credit_card_month_of_expiration' => null,
                'credit_card_year_of_expiration' => null,
                'credit_card_csv' => null,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'type' => 'credit_card',
                'paypal_user' => null,
                'credit_card_number' => '1231167890123456',
                'credit_card_month_of_expiration' => '12',
                'credit_card_year_of_expiration' => '2025',
                'credit_card_csv' => '123',
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'type' => 'credit_card',
                'paypal_user' => null,
                'credit_card_number' => '1224567777121116',
                'credit_card_month_of_expiration' => '12',
                'credit_card_year_of_expiration' => '2025',
                'credit_card_csv' => '123',
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'type' => 'paypal',
                'paypal_user' => 'user47389@example.com',
                'credit_card_number' => null,
                'credit_card_month_of_expiration' => null,
                'credit_card_year_of_expiration' => null,
                'credit_card_csv' => null,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'type' => 'paypal',
                'paypal_user' => 'user2112@example.com',
                'credit_card_number' => null,
                'credit_card_month_of_expiration' => null,
                'credit_card_year_of_expiration' => null,
                'credit_card_csv' => null,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'type' => 'paypal',
                'paypal_user' => 'user1114334@example.com',
                'credit_card_number' => null,
                'credit_card_month_of_expiration' => null,
                'credit_card_year_of_expiration' => null,
                'credit_card_csv' => null,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'type' => 'paypal',
                'paypal_user' => 'user2121222@example.com',
                'credit_card_number' => null,
                'credit_card_month_of_expiration' => null,
                'credit_card_year_of_expiration' => null,
                'credit_card_csv' => null,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'type' => 'paypal',
                'paypal_user' => 'user12112@example.com',
                'credit_card_number' => null,
                'credit_card_month_of_expiration' => null,
                'credit_card_year_of_expiration' => null,
                'credit_card_csv' => null,
                'created_at' => '2021-01-01 00:00:00',
            ],
            [
                'type' => 'paypal',
                'paypal_user' => 'user2763312@example.com',
                'credit_card_number' => null,
                'credit_card_month_of_expiration' => null,
                'credit_card_year_of_expiration' => null,
                'credit_card_csv' => null,
                'created_at' => '2021-01-01 00:00:00',
            ]
        ];

        foreach ($payments as $payment) {
            DB::table('payments')->insert($payment);
        }

        Payment::factory()->times(10)->create();
    }
}
