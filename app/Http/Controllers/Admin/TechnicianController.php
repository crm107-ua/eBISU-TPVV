<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Poblation;
use App\Services\AdminTechnicianService;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    private $adminTechnicianService;
    private $rules = [
        'password' => 'required|min:16|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'address' => 'required|string',
        'country' => 'required|exists:countries,code',
        'town-select' => 'exists:poblations,name',
        'town-input' => 'string',
        'cp' => 'required|size:5|regex:/^[0-9]*$/',
    ];
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
        $countries = Country::all();
        $poblations = Poblation::all();
        return view('dashboard.forms.crearTecnico'
            , ['countries' => $countries, 'poblations' => $poblations]);
    }

    public function showTechnicianDetail($id)
    {
        $technician = $this->adminTechnicianService->getTechnician($id);
        return view('dashboard.pages.technicianDetail', ['technician' => $technician]);
    }

    public function createTechnician(Request $request)
    {
        $request->validate([
            'town' => function ($attribute, $value, $fail) use ($request) {
                if (is_null($request->input('town-select')) && is_null($request->input('town-input'))) {
                    $fail('El campo de ciudad o pueblo es requerido.');
                }
            },
        ]);
        session(['country' => $request->country]);
        $validatedData = request()->validate($this->rules);
        try {
            $this->adminTechnicianService->createUser($validatedData, UserRole::Technician);
            return redirect()->route('admin.technicians')->with(['success' => 'Técnico creado correctamente']);
        } catch (\Exception $e) {
            return redirect()->route('admin.technicians')->with(['error' => 'Error al crear el técnico']);
        }
    }

    public function showEditTechnicianForm($id)
    {
        $technician = $this->adminTechnicianService->getTechnician($id);
        $countries = Country::all();
        $poblations = Poblation::all();
        return view('dashboard.forms.editarTecnico',
            ['technician' => $technician, 'countries' => $countries, 'poblations' => $poblations]);
    }

    public function editTechnician(Request $request, $id)
    {

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
