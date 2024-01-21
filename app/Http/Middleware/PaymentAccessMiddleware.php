<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class PaymentAccessMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        $payment = Payment::find($request->route('id'));
        if ($payment != null) {
            if (Auth::user()->role == UserRole::Business->value) {
                if ($payment->transaction->business->id == Auth::id()) {
                    return $next($request);
                }
            } else if (Auth::user()->role == UserRole::Technician->value) {
                if ($payment->tickets()->where('technician_id', Auth::id())->count() > 0)
                    return $next($request);
            } else if (Auth::user()->role == UserRole::Admin->value) {
                return $next($request);
            }
        }

        return redirect()->route('login');
    }
}
