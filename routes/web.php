<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

// Rutas provisionales para crear el front-end
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/comercios', function () {
    return view('dashboard.pages.comercios');
})->middleware(['auth', 'verified'])->name('comercios');

Route::get('/comercios-form', function () {
    return view('dashboard.forms.comercio');
})->middleware(['auth', 'verified'])->name('comercios-form');


// Route::middleware('auth')->group(function () {   
// });

require __DIR__.'/auth.php';