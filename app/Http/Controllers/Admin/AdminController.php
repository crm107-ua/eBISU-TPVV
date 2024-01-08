<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminTechnicianService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $adminTechnicianService;

    public function __construct()
    {
        $this->adminTechnicianService = new AdminTechnicianService();
    }

    public function showAdmins()
    {
        $admins = $this->adminTechnicianService->getAdmins();
        return view('dashboard.pages.admins', ['admins' => $admins]);
    }

    public function showAdminCreateForm()
    {
        return view('dashboard.forms.crearAdmin');
    }
}
