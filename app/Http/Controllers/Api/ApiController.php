<?php

namespace App\Http\Controllers\Api;

use App\Services\ApiPaymentService;
use App\Services\ApiTokenService;
use App\Http\Controllers\Controller;
use App\Models\ApiToken;
use App\Models\Business;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    /**
     * https://ea57-ua.github.io/iw.api.doc/api_newUI/
     */

    private $paymentService;
    private $apiTokenService;

    public function __construct()
    {
        $this->paymentService = new ApiPaymentService();
        $this->apiTokenService = new ApiTokenService();
    }

    public function createNewTransaction(Request $request)
    {
    }

    public function getPaginatedTransactionList(Request $request)
    {
    }

    public function fulfillPendingTransaction(Request $request, $id)
    {
    }

    public function getTransactionDetails(Request $request, $transactionId)
    {
        $includeRefound = $request->input('includeRefound', 'false');
        if ($includeRefound != 'true' && $includeRefound != 'false') {
            return response()->json([
                'error' => 'Invalid request',
                'description' => "'includeRefound' must be true or false, but '$includeRefound' was provided",
            ], 400);
        }
        $includeRefound = $includeRefound == 'true';

        if (!$transactionId) {
            return response()->json([
                'error' => 'Invalid request',
                'description' => 'Missing the transaction id',
            ], 400);
        }

        $transaction = Transaction::find($transactionId);
        if (!$transaction) {
            return response()->json([
                'error' => 'Transaction not found',
                'description' => 'The requested transaction does not exist',
            ], 404);
        }

        $token = ApiController::getRequestToken($request);

        if ($token->business_id != $transaction->business_id) {
            return response()->json([
                'error' => 'Not allowed',
                'description' => 'You can not get transactions from other business',
            ], 403);
        }

        return response()->json($this->apiTokenService->jsonify($transaction, $includeRefound), 200);
    }

    public function refoundTransaction(Request $request, $id)
    {
    }

    /**
     * @todo REMOVE THIS
     */
    public function createToken(Request $request, $id)
    {
        $token = $this->apiTokenService->createNewToken($id);
        $token = $this->apiTokenService->encode($token);
        return response($token, 201);
    }

    private static function getRequestToken(Request $request): ApiToken
    {
        return $request->attributes->get('api_token');
    }
}
