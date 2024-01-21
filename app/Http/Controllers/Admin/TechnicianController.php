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
        'cp' => 'required|size:5|regex:/^[0-9]*$/',
    ];

    private $editRules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'address' => 'required|string',
        'country' => 'required|exists:countries,code',
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
        session(['country' => $request->country]);
        $validatedData = request()->validate($this->rules);
        if($validatedData['country'] == 'ES') {
            $validatedData['town-select'] =  $request->validate(['town-select' => 'required|exists:poblations,name'])['town-select'];
        } else {
            $validatedData['town-input'] =  $request->validate(['town-input' => 'required|string|min:1|max:255'])['town-input'];
        }
        try {
            $this->adminTechnicianService->createUser($validatedData, UserRole::Technician);
            return redirect()->route('admin.technicians')->with(['success' => 'Usuario técnico creado correctamente']);
        } catch (\Exception $e) {
            return redirect()->route('admin.technicians')->with(['error' => 'Error al crear el usuario técnico']);
        }
    }

    public function showEditTechnicianForm($id)
    {
        $technician = $this->adminTechnicianService->getTechnician($id);
        $countries = Country::all();
        $poblations = Poblation::all();
        session(['country' => Country::where('code', $technician->country->code)->first()->code]);
        return view('dashboard.forms.editarTecnico',
            ['technician' => $technician, 'countries' => $countries, 'poblations' => $poblations]);
    }

    public function editTechnician(Request $request, $id)
    {
        session(['country' => $request->country]);
        $validatedData = request()->validate($this->editRules);
        if($validatedData['country'] == 'ES') {
            $validatedData['town-select'] =  $request->validate(['town-select' => 'required|exists:poblations,name'])['town-select'];
        } else {
            $validatedData['town-input'] =  $request->validate(['town-input' => 'required|string|min:1|max:255'])['town-input'];
        }
        if ($request->input('password') != null) {
            $validatedData['password'] = $request->validate(
                ['password' => 'min:16|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/'])['password'];
        }
        try {
            $this->adminTechnicianService->editUser($validatedData, $id);
            return redirect()->route('admin.technicians')->with(['success' => 'Usuario técnico editado correctamente']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Error al editar el usuario técnico']);
        }
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
