<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
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

    public function showTickets(Request $request)
    {
        //obtener tickets donde el id del negocio de la transaccion sea el mismo que el id del usuario
        $tickets = Ticket::whereHas('transaction', function ($query) {
            $query->where('business_id', Auth::id());
        });

        $tickets = $this->filterTickets($request, $tickets);
        $tickets = $tickets->paginate(10);

        if ($request->has('state') && $request->input('state') != null && $request->input('state') != '') {
            $tickets->appends(['state' => $request->input('state')]);
        }
        if ($request->has('transaction') && $request->input('transaction') != null && $request->input('transaction') != '') {
            $tickets->appends(['transaction' => $request->input('transaction')]);
        }

        $request->flash();

        return view('home.business-views.incidencias', [
            'tickets' => $tickets,
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

    private function filterTickets(Request $request, $tickets)
{
    if ($request->has('state') && $request->input('state') != null && $request->input('state') != '') {
        $tickets = $tickets->where('state', $request->input('state'));
    }
    if ($request->has('transaction') && $request->input('transaction') != null && $request->input('transaction') != '') {
        $transactionNumber = $request->input('transaction');
        $tickets = $tickets->whereHas('transaction', function ($query) use ($transactionNumber) {
            $query->where('receipt_number', $transactionNumber);
        });
    }

    return $tickets;
}
}
