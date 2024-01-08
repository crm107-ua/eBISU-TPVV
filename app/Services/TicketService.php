<?php

namespace App\Services;

use App\Models\Ticket;

class TicketService
{
    public function getTickets() {
        $tickets = Ticket::paginate(4);
        return $tickets;
    }

    public function getTicketDetail($id) {
        $ticket = Ticket::findOrFail($id);
        return $ticket;
    }
}
