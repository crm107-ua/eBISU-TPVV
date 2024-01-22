<?php

namespace App\Http\Controllers\Api;

use App\Enums\TransactionStateType;
use App\Services\ApiPaymentService;
use App\Services\ApiTokenService;
use App\Http\Controllers\Controller;
use App\Models\ApiToken;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $businessId = $this->getRequestToken($request)->business_id;
        $amount = $request->json('amount');
        $concept = $request->json('concept');
        $receiptNumber = $request->json('receipt_number');

        DB::beginTransaction();
        $transaction = $this->paymentService->createNewTransaction($businessId, $amount, $concept, $receiptNumber);
        if (!$transaction) {
            DB::rollBack();
            return response()->json([
                'error' => 'Server error',
                'description' => 'Could not register your transaction',
            ], 500);
        }

        if (!$request->json('payment')) {
            DB::commit();
            /**
             * @todo VIEW TO PROVIDE PAYMENT METHOD
             */
            return response('To do... ' . $transaction->id, 200);
        }

        $payment = $this->paymentService->savePaymentMethod($request->json('payment'));
        if (!$payment) {
            DB::rollBack();
            return response()->json([
                'error' => 'Server error',
                'description' => 'Could not register payment method',
            ], 500);
        }

        $finalized = $this->paymentService->finalizePendingTransaction($transaction->id, $payment->id);
        if (!$finalized) {
            DB::rollBack();
            return response()->json([
                'error' => 'Server error',
                'description' => 'Could not finalice transaction',
            ], 500);
        }

        DB::commit();

        $transaction->refresh();
        return response()->json($this->apiTokenService->jsonify($transaction, false), 201);
    }

    public function getPaginatedTransactionList(Request $request)
    {
    }

    public function fulfillPendingTransaction(Request $request)
    {
        $transaction = $this->getRequestTransaction($request);

        if($transaction->state !== TransactionStateType::Waiting) {
            return response()->json([
                'error' => 'Already finished',
                'description' => 'This transaction has already been finished',
            ], 400);
        }

        DB::beginTransaction();
        $payment = $this->paymentService->savePaymentMethod(self::getRequestBody($request));
        if (!$payment) {
            DB::rollBack();
            return response()->json([
                'error' => 'Server error',
                'description' => 'Could not register the payment method',
            ], 500);
        }

        $finalized = $this->paymentService->finalizePendingTransaction($transaction->id, $payment->id);
        if (!$finalized) {
            DB::rollBack();
            return response()->json([
                'error' => 'Server error',
                'description' => 'Could not finalize the transaction',
            ], 500);
        }

        DB::commit();

        $transaction->refresh();
        return response()->json($this->apiTokenService->jsonify($transaction, false), 200);
    }

    public function getTransactionDetails(Request $request)
    {
        $includeRefound = $this->getIncludeRefounded($request);
        $transaction = $this->getRequestTransaction($request);

        return response()->json($this->apiTokenService->jsonify($transaction, $includeRefound), 200);
    }

    public function refoundTransaction(Request $request)
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

    public static function getRequestToken(Request $request): ApiToken
    {
        return $request->attributes->get('api_token');
    }

    public static function getRequestBody(Request $request): array
    {
        return $request->attributes->get('json_body');
    }

    public static function getRequestTransaction(Request $request): Transaction
    {
        return $request->attributes->get('url_transaction');
    }

    public static function getIncludeRefounded(Request $request): bool
    {
        return $request->attributes->get('include_refounded');
    }
}
