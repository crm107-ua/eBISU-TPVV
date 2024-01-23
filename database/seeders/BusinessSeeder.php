<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Business;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Business::truncate();

        Business::create([
            'id' => 3,
            'cif' => 'A12345678',
            'registration_date' => now(),
            'balance' => 10000,
            'contact_info_name' => 'Santiago Feijoo',
            'contact_info_phone_number' => '123456789',
            'contact_info_email' => 'business@ebisu.com',
        ]);

        Business::create([
            'id' => 4,
            'cif' => 'A12325678',
            'registration_date' => now(),
            'balance' => 10000,
            'contact_info_name' => 'Elena Martinez',
            'contact_info_phone_number' => '123456789',
            'contact_info_email' => 'cbusiness2@ebisu.com',
        ]);

        Business::create([
            'id' => 5,
            'cif' => 'A12325578',
            'registration_date' => now(),
            'balance' => 10000,
            'contact_info_name' => 'Vanessa Sanchez',
            'contact_info_phone_number' => '123456789',
            'contact_info_email' => 'business3@ebisu.com',
        ]);

        Business::create([
            'id' => 6,
            'cif' => 'A12325178',
            'registration_date' => now(),
            'balance' => 10000,
            'contact_info_name' => 'Pedro Abascal',
            'contact_info_phone_number' => '123456789',
            'contact_info_email' => 'business4@ebisu.com',
        ]);
    }
}
