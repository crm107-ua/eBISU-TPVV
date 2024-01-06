<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TechnicianController extends Controller
{

    public function showTechnicianValorations()
    {
        $tickets = Ticket::where('technitian_id', Auth::id())
            ->where('valoration_valoration', '!=', 0)
            ->orderBy('creation_date', 'desc')
            ->paginate(2);
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

}
