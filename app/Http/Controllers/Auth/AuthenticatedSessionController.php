<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        if (Auth::user()->discharge_date != null) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'El usuario ha sido dado de baja. Ponte en contacto con el administrador para más información.']);
        }

        // Aquí se maneja la redirección basada en el rol del usuario
        if (Auth::user()->role == UserRole::Admin) {
            return redirect()->route('admin.dashboard');
        } else if (auth()->user()->role == UserRole::Technician) {
            return redirect()->route('technical-home');
        }else{
            return redirect()->route('business-home');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
