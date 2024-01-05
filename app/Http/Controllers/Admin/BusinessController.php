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
        'town' => 'required|exists:poblations,name',
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
        $validatedData = request()->validate($this->businessRules);
        try {
            $this->businessService->createBusiness($validatedData);
            return redirect()->route('admin.business')->with(['success' => 'Comercio creado correctamente']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al crear el comercio']);
        }
    }
}
