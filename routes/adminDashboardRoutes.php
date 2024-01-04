<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified','admin'])->group(function () {
    Route::get('/admin', function () {
        return view('dashboard.index');
    })->name('admin.dashboard');
});
