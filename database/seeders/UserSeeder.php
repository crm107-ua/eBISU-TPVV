<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        // Crear usuario Admin
        User::create([
            'id' => 1,
            'name' => 'Admin User',
            'email' => 'admin@ebisu.com',
            'password' => Hash::make('1234'),
            'role' => UserRole::Admin,
            'direction_direction' => 'Calle 13422',
            'direction_postal_code' => '12345',
            'direction_poblation' => 'San Vicente',
            'direction_country_id' => 199
        ]);

        // Crear usuario Tecnico
        User::create([
            'id' => 2,
            'name' => 'Technician User',
            'email' => 'technician@ebisu.com',
            'password' => Hash::make('1234'),
            'role' => UserRole::Technician,
            'direction_direction' => 'Calle 143243',
            'direction_postal_code' => '12345',
            'direction_poblation' => 'Madrid',
            'direction_country_id' => 199
        ]);

        // Crear usuario Cliente
        User::create([
            'id' => 3,
            'name' => 'Business User',
            'email' => 'business@ebisu.com',
            'password' => Hash::make('1234'),
            'role' => UserRole::Business,
            'direction_direction' => 'Calle 123124',
            'direction_postal_code' => '12345',
            'direction_poblation' => 'San Juan',
            'direction_country_id' => 199
        ]);

    }
}
