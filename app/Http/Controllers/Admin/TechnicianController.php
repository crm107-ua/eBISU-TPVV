<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminTechnicianService;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    private $adminTechnicianService;

    public function __construct()
    {
        $this->adminTechnicianService = new AdminTechnicianService();
    }

    public function showTechnicians()
    {
        $technicians = $this->adminTechnicianService->getTechnicians();
        return view('dashboard.pages.tecnicos', ['technicians' => $technicians]);
    }

    public function showTechnicianCreateForm()
    {
        return view('dashboard.forms.crearTecnico');
    }

    public function showTechnicianDetail($id)
    {
        $technician = $this->adminTechnicianService->getTechnician($id);
        return view('dashboard.pages.technicianDetail', ['technician' => $technician]);
    }

    public function dischargeTechnician($id)
    {
        $this->adminTechnicianService->dischargeTechnician($id);
        return redirect()->route('admin.technicians')->with(['success' => 'Técnico dado de baja correctamente']);
    }

    public function activateTechnicianAccount($id)
    {
        $this->adminTechnicianService->activateTechnician($id);
        return redirect()->route('admin.technicians')->with(['success' => 'Técnico activado correctamente']);
    }
    
}
