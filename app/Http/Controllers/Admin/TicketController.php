<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private $ticketService;

    public function __construct()
    {
        $this->ticketService = new TicketService();
    }

    public function showTickets()
    {
        $tickets = $this->ticketService->getTickets();
        return view('dashboard.pages.tickets', ['tickets' => $tickets]);
    }

    public function showTicketDetail($id)
    {
        $ticket = $this->ticketService->getTicketDetail($id);
        return view('dashboard.pages.detalles-incidencia', ['ticket' => $ticket]);
    }
}
