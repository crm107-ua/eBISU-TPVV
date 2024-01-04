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

    }
}
