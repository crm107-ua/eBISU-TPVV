<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

// Rutas provisionales para crear el front
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/comercios', function () {
    return view('dashboard.pages.comercios');
})->middleware(['auth', 'verified'])->name('comercios');


// Route::middleware('auth')->group(function () {   
// });

require __DIR__.'/auth.php';