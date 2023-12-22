<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Business;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserBusinessRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_is_business()
    {
        $user = new User();
        $user->name = 'Erik';
        $user->email = 'erik@gmail.com';
        $user->password = bcrypt('password');
        $user->role = 'admin';
        $user->direction_direction = 'Calle de la piruleta';
        $user->direction_postal_code = '12345';
        $user->direction_poblation = 'Madrid';

        $user->country()->associate(Country::find(1));
        $user->save();

        $business = new Business();
        $business->cif = 'A12345678';
        $business->registration_date = now();
        $business->balance = 1000;
        $business->contact_info_email = 'erik@gmail.com';
        $business->user()->associate($user);
        $business->save();

        $this->assertEquals($user->id, $business->user->id);
        $this->assertEquals($user->business->id, $business->id);
    }
}
