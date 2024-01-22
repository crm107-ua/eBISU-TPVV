<?php

namespace App\Http\Controllers;

use App\Enums\TicketStateType;
use App\Models\Technician;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\Translation\t;

class TechnicianController extends Controller
{

    public function showTechnicianValorations()
    {
        $tickets = Ticket::where('technitian_id', Auth::id())
            ->where('valoration_valoration', '!=', 0)
            ->orderBy('creation_date', 'desc')
            ->paginate(10);
        $averageValoration = Ticket::where('technitian_id', Auth::id())
            ->where('valoration_valoration', '!=', 0)
            ->avg('valoration_valoration');
        $businessContactNames = [];
        $businessNames = [];

        foreach ($tickets as $ticket) {
            $transaction = $ticket->transaction;
            $business = $transaction->business;
            $businessContactNames[] = $business->contact_info_name;
            $businessNames[] = $business->user->name;
        }

        return view('home.technical-views.valoraciones',
            ['valorations' => $tickets,
             'businessContactNames' => $businessContactNames, 'businessNames' => $businessNames,
             'averageValoration' => $averageValoration]);
    }

    public function showTechnicianTickets(Request $request)
    {
        $tickets = Ticket::where('technitian_id', Auth::id())
            ->orderByRaw("array_position(ARRAY['open', 'resolving', 'closed'], state)");

        $tickets = $this->filterTickets($request, $tickets);
        $tickets = $tickets->paginate(5);

        if ($request->has('state') && $request->input('state') != null && $request->input('state') != '') {
            $tickets->appends(['state' => $request->input('state')]);
        }
        if ($request->has('transaction') && $request->input('transaction') != null && $request->input('transaction') != '') {
            $tickets->appends(['transaction' => $request->input('transaction')]);
        }

        $request->flash();

        return view('home.technical-views.incidencias',
            ['tickets' => $tickets]);
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

    public function changeTicketState(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->state = $request->state;
        $ticket->save();
        return back();
    }

}
