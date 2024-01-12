<?php

namespace App\Http\Controllers;

use App\Enums\TicketStateType;
use App\Models\Attachment;
use App\Models\Business;
use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function showCreateTicket(Request $request, $id)
    {
        return view('home.forms.incidencia', ['id' => $id]);
    }

    public function createTicket(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'attachment' => 'file|max:1024|mimes:pdf,jpg,jpeg,png,webp,zip,rar,tar.gz',
        ]);


        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->state = TicketStateType::Open->value;

        $ticket->priority = 1;
        $ticket->creation_date = now();
        Transaction::find($id)->tickets()->save($ticket);
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $extension = $file->getClientOriginalExtension();
            $filename = $ticket->id . '_ticket_' . round(microtime(true)) . '.' . $extension;
            $file->storeAs('attachments', $filename);

            $attachment = new Attachment();
            $attachment->filename = $filename;
            $attachment->upload_date = now();
            $attachment->save();

            $ticket->attachment()->associate($attachment);
        }
        $ticket->save();

        return redirect()->route('tickets');
    }

    public function showTicket(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        return view('home.business-views.incidencia',
            ['ticket' => $ticket]);
    }

    public function valorateTicket(Request $request, $id)
    {
        $request->validate([
            'valoration' => 'required|integer|min:1|max:5',
        ]);

        $ticket = Ticket::find($id);
        $ticket->valoration_valoration = $request->valoration;
        if ($request->has('comment') && $request->comment != null) {
            $request->validate([
                'comment' => 'string',
            ]);
            if (trim($request->comment) != '') {
                $ticket->valoration_comment = trim($request->comment);
            }
        }
        $ticket->save();

        return redirect()->route('ticket', $ticket->id);
    }

    public function showTickets(Request $request)
    {
        //obtener tickets donde el id del negocio de la transaccion sea el mismo que el id del usuario
        $tickets = Ticket::whereHas('transaction', function ($query) {
            $query->where('business_id', Auth::id());
        });

        $tickets = $this->filterTickets($request, $tickets);
        $tickets = $tickets->orderBy('creation_date', 'desc');
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
