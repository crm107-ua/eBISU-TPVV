<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use App\Models\Transaction;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PaymentAccessMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        $payment = Transaction::find($request->route('id'));
        if ($payment != null) {
            if (Auth::user()->role == UserRole::Business) {
                if ($payment->business->id == Auth::id()) {
                    return $next($request);
                }
            } else if (Auth::user()->role == UserRole::Technician) {
                if ($payment->tickets->where('technitian_id', Auth::id())->count() > 0)
                    return $next($request);
            } else if (Auth::user()->role == UserRole::Admin) {
                return $next($request);
            }
        }

        return redirect()->route('login');
    }
}
