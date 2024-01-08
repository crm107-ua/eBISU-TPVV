<?php

use Illuminate\Support\Facades\Route;

// Rutas provisionales para crear el front-end
Route::get('/', function () {
    return view('home.index');
});

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

// Route::middleware('auth')->group(function () {
// });

require __DIR__.'/auth.php';
require __DIR__.'/adminDashboardRoutes.php';
