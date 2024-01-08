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
        if ($data['town-select'] != null) {
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
        $business->discharge_date = now();
        $business->save();
    }

    public function activateBusinessAccount($id) {
        $business = Business::findOrFail($id);
        $business->discharge_date = null;
        $business->save();
    }

    public function editBusiness($data, $id) {

    }
}
