<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Rutas provisionales para crear el front-end
Route::get('/', function () {
    return view('home.index');
});

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

Route::get('/valoraciones-tecnico', function () {
    return view('home.technical-views.valoraciones');
})->middleware(['auth', 'verified'])->name('valoraciones-tecnico');

Route::get('/incidencias', function () {
    return view('home.technical-views.incidencias');
})->middleware(['auth', 'verified'])->name('incidencias');

Route::get('/incidencia', function () {
    return view('home.technical-views.incidencia');
})->middleware(['auth', 'verified'])->name('incidencia');

Route::get('/mis-incidencias', function () {
    return view('home.business-views.incidencias');
})->middleware(['auth', 'verified'])->name('mis-incidencias');

Route::get('/mi-incidencia', function () {
    return view('home.business-views.incidencia');
})->middleware(['auth', 'verified'])->name('mi-incidencia');

Route::get('/pagos', function () {
    return view('home.business-views.pagos');
})->middleware(['auth', 'verified'])->name('pagos');

Route::get('/pago', function () {
    return view('home.business-views.pago');
})->middleware(['auth', 'verified'])->name('pago');

// Route::middleware('auth')->group(function () {   
// });

require __DIR__.'/auth.php';