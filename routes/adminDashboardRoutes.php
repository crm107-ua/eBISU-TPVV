<?php

use App\Http\Controllers\Admin\BusinessController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified','admin'])->group(function () {
    Route::get('/admin', function () {
        return view('dashboard.index');
    })->name('admin.dashboard');

    Route::get('/admin/business',
        [BusinessController::class, 'showBusinessList'])
        ->name('admin.business');
});


Route::get('/comercios-form', function () {
    return view('dashboard.forms.comercio');
})->middleware(['auth', 'verified'])->name('comercios-form');
