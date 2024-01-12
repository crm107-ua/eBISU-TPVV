<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\User;

class AdminTechnicianService
{
    public function getAdmins()
    {
        $users = User::where('role', UserRole::Admin)->paginate(1);
        return $users;
    }

    public function getTechnicians()
    {
        $users = User::where('role', UserRole::Technician)->paginate(1);
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
}
