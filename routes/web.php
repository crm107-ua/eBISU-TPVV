<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FulfillPendingTransactionController;

// Rutas provisionales para crear el front-end
Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::get('/technical-home', function () {
    return view('home.technical-views.technical-home');
})->middleware(['auth', 'verified', 'technician'])->name('technical-home');

Route::get('/business-home', function () {
    return view('home.business-views.business-home');
})->middleware(['auth', 'verified', 'business'])->name('business-home');

Route::get('/technician/reviews', [TechnicianController::class, 'showTechnicianValorations'])
    ->middleware(['auth', 'verified', 'technician'])->name('technician.reviews');

Route::get('/technician/tickets', [TechnicianController::class, 'showTechnicianTickets'])
    ->middleware(['auth', 'verified', 'technician'])->name('technician.tickets');

Route::post('/technician/tickets/{id}/changeState', [TechnicianController::class, 'changeTicketState'])
    ->middleware(['auth', 'verified', 'technician'])->name('technician.changeTicketState');



Route::get('/tickets', [TicketController::class, 'showTickets'])
    ->middleware(['auth', 'verified', 'business'])->name('tickets');

Route::get('/ticket/{id}', [\App\Http\Controllers\TicketController::class, 'showTicket'])
    ->middleware(['auth', 'verified', 'ticketAccess'])->name('ticket');
Route::post('/ticket/{id}/valorate', [\App\Http\Controllers\TicketController::class, 'valorateTicket'])
    ->middleware(['auth', 'verified', 'ticketAccess'])->name('valorateTicket');

Route::get('/business/token', [BusinessController::class, 'showTokenDetails'])
    ->middleware(['auth', 'verified', 'business'])->name('business-token');

Route::get('/business/token/new', [BusinessController::class, 'createNewToken'])
    ->middleware(['auth', 'verified', 'business'])->name('business-token-new');

Route::get('/payments', [BusinessController::class, 'showPayments'])
    ->middleware(['auth', 'verified', 'business'])->name('payments');

Route::get('/payment/{id}', [BusinessController::class, 'showPayment'])
    ->middleware(['auth', 'verified', 'paymentAccess'])->name('payment');

Route::get('/payment/{id}/report', [\App\Http\Controllers\TicketController::class, 'showCreateTicket'])
    ->middleware(['auth', 'verified', 'paymentAccess'])->name('report');

Route::post('/payment/{id}/report', [\App\Http\Controllers\TicketController::class, 'createTicket'])
    ->middleware(['auth', 'verified', 'paymentAccess'])->name('createReport');

Route::get('/terminos-condiciones', function () {
    return view('home.general-views.terminos');
})->name('terminos-condiciones');

Route::get('/downloadFile/{id}', [TicketController::class, 'downloadFile'])
    ->middleware(['auth', 'verified', 'attachmentAccess'])->name('downloadFile');
Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('send.email');

Route::post('/ticket/{id}/comment', [\App\Http\Controllers\TicketController::class, 'addComment'])
    ->middleware(['auth', 'verified', 'ticketAccess'])->name('addComment');

Route::get('404', function () {
    $htmlContent = file_get_contents(resource_path('views/dashboard/template/pages/samples/error-404.html'));
    return response($htmlContent, 404);
})->name('404');

Route::get('/fulfill-transaction/{id}', [FulfillPendingTransactionController::class, 'getPaymentForm'])
    ->name('payment.get.form');
Route::post('/fulfill-transaction/{id}', [FulfillPendingTransactionController::class, 'postPaymentForm'])
    ->name('payment.post.form');
Route::get('/fulfill-transaction/{id}/result', [FulfillPendingTransactionController::class, 'getResultView'])
    ->name('payment.get.result');

require __DIR__.'/auth.php';
require __DIR__.'/adminDashboardRoutes.php';