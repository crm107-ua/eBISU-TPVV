<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TechnicianController;
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
    ->middleware(['auth', 'verified','technician'])->name('technician.reviews');

Route::get('/incidencias', function () {
    return view('home.technical-views.incidencias');
})->middleware(['auth', 'verified'])->name('incidencias');

Route::get('/incidencia', function () { //TODO añadir enlace a esta pagina en la vista de valoraciones
    return view('home.technical-views.incidencia');
})->middleware(['auth', 'verified'])->name('incidencia');

Route::get('/mis-incidencias', function () {
    return view('home.business-views.incidencias');
})->middleware(['auth', 'verified'])->name('mis-incidencias');

Route::get('/mi-incidencia', function () {
    return view('home.business-views.incidencia');
})->middleware(['auth', 'verified'])->name('mi-incidencia');

Route::get('/generar-token', function () {
    return view('home.business-views.token');
})->middleware(['auth', 'verified'])->name('generar-token');

Route::get('/payments', [BusinessController::class, 'showPayments'])
    ->middleware(['auth', 'verified'])->name('payments');

Route::get('/payment/{id}', [BusinessController::class, 'showPayment'])->middleware(['auth', 'verified'])->name('payment');

Route::get('/crear-incidencia', function () {
    return view('home.forms.incidencia');
})->middleware(['auth', 'verified'])->name('crear-incidencia');

Route::get('/terminos-condiciones', function () {
    return view('home.general-views.terminos');
})->name('terminos-condiciones');

// Route::middleware('auth')->group(function () {
// });


Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('send.email');

require __DIR__.'/auth.php';
