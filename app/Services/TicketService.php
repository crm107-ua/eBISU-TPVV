<?php

namespace App\Services;

use App\Models\Technician;
use App\Models\Ticket;

class TicketService
{
    public function getTickets() {
        $tickets = Ticket::query();
        return $tickets;
    }

    public function getTicketDetail($id) {
        $ticket = Ticket::findOrFail($id);
        return $ticket;
    }

    public function getTicketAttachment($id) {
        $ticket = Ticket::findOrFail($id);
        return $ticket->attachment;
    }

    public function assignTechnician($id, $technicianId) {
        $ticket = Ticket::findOrFail($id);
        $tech = Technician::findOrFail($technicianId);
        if ($tech) {
            $ticket->technitian_id = $technicianId;
            $ticket->save();
        }
    }
}
