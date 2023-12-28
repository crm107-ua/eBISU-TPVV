<?php

namespace Tests\Unit;

use App\Enums\UserRole;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Business;
use App\Models\ApiToken;
use App\Models\Country;
use App\Models\User;

class BusinessApiTokenRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_business_has_api_token() {
        $user = new User();
        $user->name = 'Erik';
        $user->email = 'erik@gmail.com';
        $user->password = bcrypt('password');
        $user->role = UserRole::Business;
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

        $apiToken = new ApiToken();
        $apiToken->issuer = 'Test Issuer';
        $apiToken->expiration_date = now()->addDays(10);
        $apiToken->business()->associate($business);
        $apiToken->save();

        $this->assertEquals($business->id, $apiToken->business->id);
        $this->assertEquals($business->apiTokens->first()->id, $apiToken->id);
    }
}
