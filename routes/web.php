<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;

// Rutas provisionales para crear el front-end
Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/comercios-form', function () {
    return view('dashboard.forms.comercio');
})->middleware(['auth', 'verified'])->name('comercios-form');

Route::get('/admin-form', function () {
    return view('dashboard.forms.admin');
})->middleware(['auth', 'verified'])->name('admin-form');

Route::get('/tecnico-form', function () {
    return view('dashboard.forms.tecnico');
})->middleware(['auth', 'verified'])->name('tecnico-form');

Route::get('/listado-comercios', function () {
    return view('dashboard.pages.comercios');
})->middleware(['auth', 'verified'])->name('comercios');

Route::get('/listado-admins', function () {
    return view('dashboard.pages.admins');
})->middleware(['auth', 'verified'])->name('admins');

Route::get('/listado-tecnicos', function () {
    return view('dashboard.pages.tecnicos');
})->middleware(['auth', 'verified'])->name('tecnicos');

Route::get('/listado-incidencias', function () {
    return view('dashboard.pages.incidencias');
})->middleware(['auth', 'verified'])->name('incidencias');

Route::get('/detalles-incidencia', function () {
    return view('dashboard.pages.detalles-incidencia');
})->middleware(['auth', 'verified'])->name('detalles-incidencia');

Route::get('/tokens-admin', function () {
    return view('dashboard.pages.tokens');
})->middleware(['auth', 'verified'])->name('tokens-admin');

Route::get('/technical-home', function () {
    return view('home.technical-views.technical-home');
})->middleware(['auth', 'verified'])->name('technical-home');

Route::get('/business-home', function () {
    return view('home.business-views.business-home');
})->middleware(['auth', 'verified'])->name('business-home');

Route::get('/technician/reviews', [TechnicianController::class, 'showTechnicianValorations'])
    ->middleware(['auth', 'verified', 'technician'])->name('technician.reviews');

Route::get('/incidencias', function () {
    return view('home.technical-views.incidencias');
})->middleware(['auth', 'verified'])->name('incidencias');

Route::get('/incidencia', function () {
    return view('home.technical-views.incidencia');
})->middleware(['auth', 'verified'])->name('incidencia');

Route::get('/tickets', [TicketController::class, 'showTickets'])
    ->middleware(['auth', 'verified', 'business'])->name('tickets');

Route::get('/ticket/{id}', [\App\Http\Controllers\TicketController::class, 'showTicket'])
    ->middleware(['auth', 'verified', 'ticketAccess'])->name('ticket');
Route::post('/ticket/{id}/valorate', [\App\Http\Controllers\TicketController::class, 'valorateTicket'])
    ->middleware(['auth', 'verified', 'ticketAccess'])->name('valorateTicket');

Route::get('/generar-token', [BusinessController::class, 'showTokenDetails'])->middleware(['auth', 'verified', 'business'])->name('generar-token');
Route::get('/generar-token/nuevo', [BusinessController::class, 'createNewToken'])->middleware(['auth', 'verified', 'business'])->name('crear-generar-token');

Route::get('/payments', [BusinessController::class, 'showPayments'])
    ->middleware(['auth', 'verified', 'business'])->name('payments');

Route::get('/payment/{id}', [BusinessController::class, 'showPayment'])
    ->middleware(['auth', 'verified', 'paymentAccess'])->name('payment');

Route::get('/payment/{id}/report', [\App\Http\Controllers\TicketController::class, 'showCreateTicket'])
    ->middleware(['auth', 'verified', 'paymentAccess'])->name('report');
Route::post('/payment/{id}/report', [\App\Http\Controllers\TicketController::class, 'createTicket'])
    ->middleware(['auth', 'verified', 'paymentAccess'])->name('createReport');

Route::get('/terminos-condiciones', function () {
    return view('home.general-views.terminos');
})->name('terminos-condiciones');

// Route::middleware('auth')->group(function () {
// });
Route::get('/downloadFile/{id}', [TicketController::class, 'downloadFile'])
    ->middleware(['auth', 'verified', 'attachmentAccess'])->name('downloadFile');
Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('send.email');

Route::post('/ticket/{id}/comment', [\App\Http\Controllers\TicketController::class, 'addComment'])
    ->middleware(['auth', 'verified', 'ticketAccess'])->name('addComment');
require __DIR__ . '/auth.php';
