<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Business;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoBusinessUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $businessUser1 = User::updateOrCreate(
            ['email' => 'javi.centrodeportivo@ebisu.client.com'],
            [
                'name' => 'Centro Deportivo',
                'password' => Hash::make('VFx7Vq88WvH#Z4*1IfIH'),
                'role' => UserRole::Business,
                'direction_direction' => 'Calle 123124',
                'direction_postal_code' => '12345',
                'direction_poblation' => 'San Juan',
                'direction_country_id' => 199
            ]
        );

        Business::updateOrCreate(
            ['id' => $businessUser1->id],
            [
                'contact_info_email' => $businessUser1->email,
                'contact_info_phone_number' => '123456789',
                'contact_info_name' => $businessUser1->name,
                'cif' => 'A15745678',
                'registration_date' => now(),
                'balance' => 8000
            ]
        );


        $businessUser2 = User::updateOrCreate(
            ['email' => 'adrian.g9@ebisu.client.com'],
            [
                'name' => 'Grupo 9',
                'password' => Hash::make('M0TwWkZUsEgwSX@kTk6d'),
                'role' => UserRole::Business,
                'direction_direction' => 'Calle 123124',
                'direction_postal_code' => '12345',
                'direction_poblation' => 'San Juan',
                'direction_country_id' => 199
            ]
        );

        Business::updateOrCreate(
            ['id' => $businessUser2->id],
            [
                'contact_info_email' => $businessUser2->email,
                'contact_info_phone_number' => '123456789',
                'contact_info_name' => $businessUser2->name,
                'cif' => 'A15745609',
                'registration_date' => now(),
                'balance' => 8000
            ]
        );

        $businessUser3 = User::updateOrCreate(
            ['email' => 'noel.g4@ebisu.client.com'],
            [
                'name' => 'Grupo 4',
                'password' => Hash::make('OcVK3!YaO?ooy1w4SJsS'),
                'role' => UserRole::Business,
                'direction_direction' => 'Calle 123124',
                'direction_postal_code' => '12345',
                'direction_poblation' => 'San Juan',
                'direction_country_id' => 199
            ]
        );

        Business::updateOrCreate(
            ['id' => $businessUser3->id],
            [
                'contact_info_email' => $businessUser3->email,
                'contact_info_phone_number' => '123456789',
                'contact_info_name' => $businessUser3->name,
                'cif' => 'A19945609',
                'registration_date' => now(),
                'balance' => 8000
            ]
        );

        $businessUser4 = User::updateOrCreate(
            ['email' => 'joseantonio.clubtenis@ebisu.client.com'],
            [
                'name' => 'Club Tenis',
                'password' => Hash::make('!vBnMX3MUMyjAa1mMeOI'),
                'role' => UserRole::Business,
                'direction_direction' => 'Calle 123124',
                'direction_postal_code' => '12345',
                'direction_poblation' => 'San Juan',
                'direction_country_id' => 199
            ]
        );

        Business::updateOrCreate(
            ['id' => $businessUser4->id],
            [
                'contact_info_email' => $businessUser4->email,
                'contact_info_phone_number' => '123456789',
                'contact_info_name' => $businessUser4->name,
                'cif' => 'A19999909',
                'registration_date' => now(),
                'balance' => 8000
            ]
        );

    }
}
