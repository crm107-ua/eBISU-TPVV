<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class dischargeValidatorMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->discharge_date != null) {
            // Copipaste de logout. Como logout lleva a '/' y quiero que lleve a '/login' hago esto. Si hay mejor opcion pos se puede ver.
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with(['error' => 'El usuario ha sido dado de baja. Ponte en contacto con el administrador para más información.']);
        }
        return $next($request);
    }
}
