<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\Business;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BusinessService
{
    public function getBusinessPaginatedList() {
        return Business::paginate(5);
    }

    public function createBusiness($data) {
        $user = new User();
        $user->name = $data['business-name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = UserRole::Business;
        $user->direction_direction = $data['address'];
        $user->direction_postal_code = $data['cp'];
        if ($data['country'] == 'ES') {
            $user->direction_poblation = $data['town-select'];
        } else {
            $user->direction_poblation = $data['town-input'];
        }
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

    public function getBusinessById($id) {
        return Business::findOrFail($id);
    }

    public function dischargeBusiness($id) {
        $business = Business::findOrFail($id);
        $user = $business->user;
        $user->discharge_date = now();
        $user->save();
    }

    public function activateBusinessAccount($id) {
        $business = Business::findOrFail($id);
        $user = $business->user;
        $user->discharge_date = null;
        $user->save();
    }

    public function editBusiness($data, $id) {
        $business = Business::findOrFail($id);
        $user = $business->user;
        $user->name = $data['business-name'];
        $user->email = $data['email'];
        $user->direction_direction = $data['address'];
        $user->direction_postal_code = $data['cp'];

        if (array_key_exists( 'password', $data )) {
            $user->password = Hash::make($data['password']);
        }

        if ($data['country'] == 'ES') {
            $user->direction_poblation = $data['town-select'];
        } else {
            $user->direction_poblation = $data['town-input'];
        }
        $user->country()->associate(Country::where('code', $data['country'])->firstOrFail());
        $user->save();

        $business->cif = $data['cif'];
        $business->contact_info_name = $data['contact-name'];
        $business->contact_info_phone_number = $data['phone'];
        $business->contact_info_email = $data['email'];
        $business->save();
    }
}
