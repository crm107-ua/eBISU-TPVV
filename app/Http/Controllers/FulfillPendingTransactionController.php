<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Transaction;
use Illuminate\Http\Request;

class FulfillPendingTransactionController extends Controller
{
    public function getPaymentForm(Request $request)
    {
        return view('payment.paymentForm', [
            'business' => Business::find(6),
            'transaction' => Transaction::find(8),
        ]);
    }

    public function postPaymentForm(Request $request)
    {

    }

    public function getResultView(Request $request)
    {
    }
}
