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

    Route::get('/admin/business/create',
        [BusinessController::class, 'showBusinessCreateForm'])
        ->name('admin.business.create');

    Route::post('/admin/business/create',
        [BusinessController::class, 'createBusiness'])
        ->name('admin.business.create.post');
});
