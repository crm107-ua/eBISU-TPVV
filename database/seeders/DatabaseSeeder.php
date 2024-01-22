<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BusinessSeeder::class,
            TechnicianSeeder::class,
            ApiTokenSeeder::class,
            AttachmentSeeder::class,
            PaymentSeeder::class,
            TransactionSeeder::class,
            TicketSeeder::class,
            CommentSeeder::class,
        ]);
    }
}