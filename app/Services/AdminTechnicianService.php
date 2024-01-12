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

}
