<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\Business;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use function Symfony\Component\String\b;

class BusinessService
{
    public function getBusinessPaginatedList() {
        return Business::paginate(2);
    }

    public function createBusiness($data) {
        $user = new User();
        $user->name = $data['business-name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = UserRole::Business;
        $user->direction_direction = $data['address'];
        $user->direction_postal_code = $data['cp'];
        $user->direction_poblation = $data['town'];
        $user->country()->associate(Country::where('code', $data['country'])->firstOrFail());
        $user->save();

        $business = new Business();
        $business->cif = $data['cif'];
        $business->contact_info_name = $data['contact-name'];
        $business->contact_info_phone_number = $data['phone'];
        $business->contact_info_email = $data['email'];
        $business->balance = 0;
        $business->registration_date = now();
        $business->user()->associate($user);
        $business->save();
    }
}
