<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technician;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private $ticketService;

    public function __construct()
    {
        $this->ticketService = new TicketService();
    }

    public function showTickets(Request $request)
    {
        $tickets = $this->ticketService->getTickets();
        $tickets = $this->filter($tickets, $request);
        $tickets = $tickets->paginate(5)->withQueryString();
        $technitians = Technician::all();
        return view('dashboard.pages.tickets',
            ['tickets' => $tickets, 'technitians' => $technitians,]);
    }

    public function filter($tickets, $request)
    {
        if ($request->has('state')) {
            $tickets = $tickets->where('state', $request->input('state'));
        }

        if ($request->has('technitian')) {
            $tickets = $tickets->where('technitian_id', $request->input('technitian'));
        }

        if ($request->has('date')) {
            $date = $request->input('date');
            $tickets = $tickets->whereDate('creation_date', $date);
        }

        return $tickets;
    }

    public function showTicketDetail($id)
    {
        $ticket = $this->ticketService->getTicketDetail($id);
        $technitians = Technician::all();
        return view('dashboard.pages.detalles-incidencia',
            ['ticket' => $ticket, 'technitians' => $technitians]);
    }

    public function downloadAttachment($id)
    {
        $attachment = $this->ticketService->getTicketAttachment($id);

        if (!$attachment) {
            return back()->with('error', 'File not found.');
        }
        $attachmentPath = storage_path('app/' . $attachment->filepath);

        if (file_exists($attachmentPath)) {
            return response()->download($attachmentPath, $attachment->filename);
        }

        return back()->with('error', 'File not found.');
    }

    public function assignTechnician(Request $request, $id)
    {
        try {
            $this->ticketService->assignTechnician($id, $request->techID);
            return back()->with('success', 'Technician assigned successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error assigning technician.');
        }
    }
}
