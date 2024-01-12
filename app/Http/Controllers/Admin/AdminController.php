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

    public function showAdminDetail($id)
    {
        $admin = $this->adminTechnicianService->getAdmin($id);
        return view('dashboard.pages.adminDetail', ['admin' => $admin]);
    }

    public function dischargeAdmin($id)
    {
        $this->adminTechnicianService->dischargeAdmin($id);
        return redirect()->route('admin.admins')->with(['success' => 'Administrador dado de baja correctamente']);
    }

    public function activateAdminAccount($id)
    {
        $this->adminTechnicianService->activateAdmin($id);
        return redirect()->route('admin.admins')->with(['success' => 'Administrador activado correctamente']);
    }
}
