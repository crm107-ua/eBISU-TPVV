<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use App\Models\Ticket;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TicketAccessMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        $ticket = Ticket::find($request->route('id'));
        if ($ticket != null) {
            if (Auth::user()->role == UserRole::Business->value) {
                if ($ticket->transaction->business->id == Auth::id()) {
                    return $next($request);
                }
            } else if (Auth::user()->role == UserRole::Technician->value) {
                if ($ticket->technician_id != Auth::id()) {
                    return $next($request);
                }
            } else if (Auth::user()->role == UserRole::Admin->value) {
                return $next($request);
            }
        }

        return redirect()->route('login');
    }
}
