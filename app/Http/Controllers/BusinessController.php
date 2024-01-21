<?php

namespace App\Http\Controllers;

use App\Models\ApiToken;
use App\Models\Business;
use App\Models\Transaction;
use App\Services\ApiTokenService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{

    private $apiTokenService;

    public function __construct()
    {
        $this->apiTokenService = new ApiTokenService();
    }

    public function showPayments(Request $request)
    {
        $business = Business::find(Auth::id());
        $payments = $business->transactions();
        $payments = $this->filterPayments($request, $payments);
        $payments = $payments->paginate(10);
        if ($request->has('state') && $request->input('state') != null && $request->input('state') != '') {
            $payments->appends(['state' => $request->input('state')]);
        }
        if ($request->has('emision_date') && $request->input('emision_date') != null) {
            $payments->appends(['emision_date' => $request->input('emision_date')]);
        }
        $request->flash();

        return view('home.business-views.pagos', [
            'payments' => $payments,
        ]);
    }




    public function showPayment(Request $request, $id)
    {
        $payment = Transaction::find($id);

        if ($payment == null) {
            return redirect()->route('payments');
        }
        //TODO a menos que haya una mejor idea, si la id->business_id no es la misma que la del usuario, redirigir a la lista de pagos
        if ($payment->business_id != Auth::id()) {
            return redirect()->route('payments');
        }

        return view('home.business-views.pago', [
            'payment' => $payment,
        ]);
    }

    private function filterPayments(Request $request, $payments)
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


    public function showTokenDetails(Request $request)
    {
        $latestToken = $this->apiTokenService->getLatestToken(Auth::id());
        if(!$latestToken)
            $latestToken = $this->apiTokenService->createNewToken(Auth::id());

        $encodedToken = $this->apiTokenService->encode($latestToken);
        $totalUses = ApiToken::where('business_id', '=', Auth::id())->sum('times_used');

        return view('home.business-views.token', [
            'totalUses' => $totalUses,
            'token' => $latestToken,
            'encodedToken' => $encodedToken,
        ]);
    }

    public function createNewToken(Request $request)
    {
        $this->apiTokenService->createNewToken(Auth::id());
        return redirect()->route('generar-token');
    }
}
