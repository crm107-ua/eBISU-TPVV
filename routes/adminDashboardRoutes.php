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

    Route::get('/admin/business/{id}',
        [BusinessController::class, 'showBusinessDetail'])
        ->name('admin.business.details');

    Route::get('/admin/business/{id}/discharge',
        [BusinessController::class, 'dischargeBusiness'])
        ->name('admin.business.discharge');

    Route::get('/admin/business/{id}/activate',
        [BusinessController::class, 'activateBusinessAccount'])
        ->name('admin.business.activate');

    Route::get('/admin/business/{id}/edit',
        [BusinessController::class, 'showBusinessEditForm'])
        ->name('admin.business.edit');

    Route::post('/admin/business/{id}/edit',
        [BusinessController::class, 'editBusiness'])
        ->name('admin.business.edit.post');
});
