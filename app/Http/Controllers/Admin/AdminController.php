<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Poblation;
use App\Services\AdminTechnicianService;
use Illuminate\Http\Request;

class AdminController extends Controller
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

    public function showAdmins()
    {
        $admins = $this->adminTechnicianService->getAdmins();
        return view('dashboard.pages.admins', ['admins' => $admins]);
    }

    public function showAdminCreateForm()
    {
        $countries = Country::all();
        $poblations = Poblation::all();
        return view('dashboard.forms.crearAdmin',
            ['countries' => $countries, 'poblations' => $poblations]);
    }

    public function createAdmin(Request $request) {
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
            $this->adminTechnicianService->createUser($validatedData, UserRole::Admin);
            return redirect()->route('admin.admins')->with(['success' => 'Administrador creado correctamente']);
        } catch (\Exception $e) {
            return redirect()->route('admin.admins')->with(['error' => 'Error al crear el administrador']);
        }
    }

    public function showAdminEditForm($id) {
        $admin = $this->adminTechnicianService->getAdmin($id);
        $countries = Country::all();
        $poblations = Poblation::all();
        return view('dashboard.forms.editarAdmin',
            ['admin' => $admin, 'countries' => $countries, 'poblations' => $poblations]);
    }

    public function editAdmin(Request $request, $id) {

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
