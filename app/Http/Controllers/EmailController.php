<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Dirección de correo electrónico del administrador (del .env)
        $adminEmail = env('ADMIN_EMAIL');

        // Dirección de correo electrónico del usuario (del formulario)
        $userEmail = $request->email;

        $title = "Un cordial saludo";
        $body = "Gracias por confiar en eBISU. En breve nos pondremos en contacto contigo.<br><br>Un saludo.<br><br><b>Este es un correo automático, por favor no lo responda.</b>";

        $title_admin = "Nuevo contacto";
        $body_admin = "El siguiente usuario ha solicitado información: ".$userEmail;

        // Enviar correo al usuario
        Mail::to($userEmail)->send(new ContactMail($title, $body));

        // Enviar correo al administrador
        Mail::to($adminEmail)->send(new ContactMail($title_admin, $body_admin));

        return back()->with('success', 'Te hemos enviado un correo de contacto.');
    }
}