<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\Admin\TicketController;
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

    Route::get('admin/admins',
        [AdminController::class, 'showAdmins'])
        ->name('admin.admins');

    Route::get('admin/admins/create',
        [AdminController::class, 'showAdminCreateForm'])
        ->name('admin.admins.create');

    Route::get('admin/admins/{id}',
        [AdminController::class, 'showAdminDetail'])
        ->name('admin.admins.details');

    Route::get('admin/admins/{id}/discharge',
        [AdminController::class, 'dischargeAdmin'])
        ->name('admin.admins.discharge');

    Route::get('admin/admins/{id}/activate',
        [AdminController::class, 'activateAdminAccount'])
        ->name('admin.admins.activate');

    Route::get('/admin/technicians',
        [TechnicianController::class, 'showTechnicians'])
        ->name('admin.technicians');

    Route::get('/admin/technicians/create',
        [TechnicianController::class, 'showTechnicianCreateForm'])
        ->name('admin.technicians.create');

    Route::get('/admin/technicians/{id}',
        [TechnicianController::class, 'showTechnicianDetail'])
        ->name('admin.technicians.details');

    Route::get('/admin/technicians/{id}/discharge',
        [TechnicianController::class, 'dischargeTechnician'])
        ->name('admin.technicians.discharge');

    Route::get('/admin/technicians/{id}/activate',
        [TechnicianController::class, 'activateTechnicianAccount'])
        ->name('admin.technicians.activate');

    Route::get('/admin/tickets',
        [TicketController::class, 'showTickets'])
        ->name('admin.tickets');

    Route::get('/admin/tickets/{id}',
        [TicketController::class, 'showTicketDetail'])
        ->name('admin.tickets.details');

    Route::get('admin/tickets/{id}/attachment',
        [TicketController::class, 'downloadAttachment'])
        ->name('admin.tickets.download.attachment');

    Route::post('/admin/tickets/{id}/assign',
        [TicketController::class, 'assignTechnician'])
        ->name('admin.tickets.assign');
});
