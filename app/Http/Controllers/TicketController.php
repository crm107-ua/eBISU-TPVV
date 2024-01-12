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
}
