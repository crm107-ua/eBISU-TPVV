<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminTechnicianService
{
    public function getAdmins()
    {
        $users = User::where('role', UserRole::Admin)->paginate(5);
        return $users;
    }

    public function getTechnicians()
    {
        $users = User::where('role', UserRole::Technician)->paginate(5);
        return $users;
    }

    public function getAdmin($id)
    {
        $user = User::where('id', $id)->where('role', UserRole::Admin)->first();
        return $user;
    }

    public function getTechnician($id)
    {
        $user = User::where('id', $id)->where('role', UserRole::Technician)->first();
        return $user;
    }

    public function dischargeAdmin($id)
    {
        $user = User::where('id', $id)->where('role', UserRole::Admin)->first();
        $user->discharge_date = now();
        $user->save();
    }

    public function dischargeTechnician($id)
    {
        $user = User::where('id', $id)->where('role', UserRole::Technician)->first();
        $user->discharge_date = now();
        $user->save();
    }

    public function activateAdmin($id)
    {
        $user = User::where('id', $id)->where('role', UserRole::Admin)->first();
        $user->discharge_date = null;
        $user->save();
    }

    public function activateTechnician($id)
    {
        $user = User::where('id', $id)->where('role', UserRole::Technician)->first();
        $user->discharge_date = null;
        $user->save();
    }

    public function createUser($data, $rol)
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = $rol;
        $user->direction_direction = $data['address'];
        $user->direction_postal_code = $data['cp'];
        if ($data['country'] == 'ES') {
            $user->direction_poblation = $data['town-select'];
        } else {
            $user->direction_poblation = $data['town-input'];
        }
        $user->country()->associate(Country::where('code', $data['country'])->firstOrFail());
        $user->save();
    }

    public function editUser($data, $id)
    {
        $user = User::where('id', $id)->first();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->direction_direction = $data['address'];
        $user->direction_postal_code = $data['cp'];
        if ($data['country'] == 'ES') {
            $user->direction_poblation = $data['town-select'];
        } else {
            $user->direction_poblation = $data['town-input'];
        }
        $user->country()->associate(Country::where('code', $data['country'])->firstOrFail());
        $user->save();
    }
}
