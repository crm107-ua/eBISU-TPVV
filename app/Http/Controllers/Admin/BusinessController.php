<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Poblation;
use App\Services\BusinessService;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    private $businessService;

    private $businessRules = [
        'cif' => 'required|unique:businesses,cif|size:9|regex:/^[A-Z][0-9]{8}$/',
        'contact-name' => 'string',
        'password' => 'required|min:16|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
        'business-name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'phone' => 'regex:/^[\+0-9]*$/',
        'address' => 'required|string',
        'country' => 'required|exists:countries,code',
        'cp' => 'required|size:5|regex:/^[0-9]*$/',
    ];

    private $editRules = [
        'cif' => 'required|size:9|regex:/^[A-Z][0-9]{8}$/',
        'contact-name' => 'string',
        'business-name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'regex:/^[\+0-9]*$/',
        'address' => 'required|string',
        'country' => 'required|exists:countries,code',
        'cp' => 'required|size:5|regex:/^[0-9]*$/',
    ];

    public function __construct()
    {
        $this->businessService = new BusinessService();
    }
    public function showBusinessList(Request $request)
    {
        $businessList = $this->businessService->getBusinessPaginatedList();
        return view('dashboard.pages.comercios', ['businessList' => $businessList]);
    }

    public function showBusinessCreateForm(Request $request)
    {
        $countries = Country::all();
        $poblations = Poblation::all();
        return view('dashboard.forms.crearComercio',
            ['countries' => $countries, 'poblations' => $poblations]);
    }

    public function createBusiness(Request $request)
    {
        session(['country' => $request->country]);
        $validatedData = request()->validate($this->businessRules);
        if($validatedData['country'] == 'ES') {
           $validatedData['town-select'] =  $request->validate(['town-select' => 'required|exists:poblations,name'])['town-select'];
        } else {
            $validatedData['town-input'] =  $request->validate(['town-input' => 'required|string|min:1|max:255'])['town-input'];
        }
        try {
            $this->businessService->createBusiness($validatedData);
            return redirect()->route('admin.business')->with(['success' => 'Comercio creado correctamente']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Error al crear el comercio']);
        }
    }

    public function showBusinessDetail(Request $request, $id)
    {
        $business = $this->businessService->getBusinessById($id);
        return view('dashboard.pages.detallesComercio', ['business' => $business]);
    }

    public function dischargeBusiness(Request $request, $id)
    {
        $this->businessService->dischargeBusiness($id);
        return redirect()->route('admin.business')->with(['success' => 'Comercio dado de baja correctamente']);
    }

    public function activateBusinessAccount(Request $request, $id)
    {
        $this->businessService->activateBusinessAccount($id);
        return redirect()->route('admin.business')->with(['success' => 'Cuenta de comercio activada correctamente']);
    }

    public function showBusinessEditForm(Request $request, $id)
    {
        $business = $this->businessService->getBusinessById($id);
        $countries = Country::all();
        $poblations = Poblation::all();
        return view('dashboard.forms.editarComercio',
            ['business' => $business, 'countries' => $countries, 'poblations' => $poblations]);
    }

    public function editBusiness(Request $request, $id)
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
            $this->businessService->editBusiness( $validatedData, $id);
            return redirect()->route('admin.business')->with(['success' => 'Comercio editado correctamente']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Error al editar el comercio']);
        }
    }

}
