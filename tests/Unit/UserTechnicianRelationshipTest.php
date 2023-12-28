<?php

namespace Tests\Unit;

use App\Enums\UserRole;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Country;
use App\Models\Technician;

class UserTechnicianRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_is_technician()
    {
        $user = new User();
        $user->name = 'Erik';
        $user->email = 'erik@gmail.com';
        $user->password = bcrypt('password');
        $user->role =UserRole::Admin;
        $user->direction_direction = 'Calle de la piruleta';
        $user->direction_postal_code = '12345';
        $user->direction_poblation = 'Madrid';

        $user->country()->associate(Country::find(1));
        $user->save();

        $technician = new Technician();
        $technician->user()->associate($user);
        $technician->save();

        $this->assertEquals($user->id, $technician->user->id);
        $this->assertEquals($technician->id, $user->technician->id);
    }
}
