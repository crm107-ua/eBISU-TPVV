<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/transactions', [ApiController::class, 'createNewTransaction'])
    ->middleware(['api.json', 'api.validation.requesttransactioncreation', 'api.token']);
Route::get('/transactions', [ApiController::class, 'getPaginatedTransactionList'])
    ->middleware(['api.transaction.refounded', 'api.token']);
Route::post('/transactions/{id}', [ApiController::class, 'fulfillPendingTransaction'])
    ->middleware(['api.json', 'api.validation.paymentinformation', 'api.token', 'api.transaction.url', 'api.transaction.access']);
Route::get('/transactions/{id}', [ApiController::class, 'getTransactionDetails'])
    ->middleware(['api.transaction.refounded', 'api.token', 'api.transaction.url', 'api.transaction.access']);
Route::post('/transactions/{id}/refound', [ApiController::class, 'refoundTransaction'])
    ->middleware(['api.transaction.refounded', 'api.json', 'api.validation.requestrefoundinformation', 'api.token', 'api.transaction.url',  'api.transaction.access']);
