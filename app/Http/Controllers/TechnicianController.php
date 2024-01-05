<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TechnicianController extends Controller
{

    public function showTechnicianValorations()
    {
        $tickets = Ticket::where('technitian_id', Auth::id())->paginate(5);
        $tickets = Ticket::paginate(5);

        return view('home.technical-views.valoraciones', ['valorations' => $tickets]);
    }

}
