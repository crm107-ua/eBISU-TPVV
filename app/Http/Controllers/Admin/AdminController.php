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
        session(['country' => $request->country]);
        $validatedData = request()->validate($this->rules);
        if($validatedData['country'] == 'ES') {
            $validatedData['town-select'] =  $request->validate(['town-select' => 'required|exists:poblations,name'])['town-select'];
        } else {
            $validatedData['town-input'] =  $request->validate(['town-input' => 'required|string|min:1|max:255'])['town-input'];
        }
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
        session(['country' => Country::where('code', $admin->country->code)->first()->code]);
        return view('dashboard.forms.editarAdmin',
            ['admin' => $admin, 'countries' => $countries, 'poblations' => $poblations]);
    }

    public function editAdmin(Request $request, $id) {
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
            return redirect()->route('admin.admins')->with(['success' => 'Administrador editado correctamente']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Error al editar el administrador']);
        }
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
