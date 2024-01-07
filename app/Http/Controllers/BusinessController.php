<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    public function showPayments(Request $request)
    {
        $business = Business::find(Auth::id());
        $payments = $business->transactions();
        $payments = $this->filter($request, $payments);
        $payments = $payments->paginate(2);

        $request->flash();

        return view('home.business-views.pagos', [
            'payments' => $payments,
        ]);
    }

    private function filter(Request $request, $payments)
    {
        if ($request->has('state') && $request->input('state') != null && $request->input('state') != '') {
            $payments = $payments->where('state', $request->input('state'));
        }
        if ($request->has('emision_date') && $request->input('emision_date') != null) {
            $date = date('Y-m-d', strtotime($request->input('emision_date')));
            $payments = $payments->whereRaw('DATE(emision_date) = ?', [$date]);
        }
        return $payments;
    }
}
