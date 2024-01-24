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
            return redirect()->route('payment.get.form', ['id' => $transaction->id]);
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

        $transaction->result_seen = true;
        if (!$transaction->save()) {
            DB::rollBack();
            return response()->json([
                'error' => 'Server error',
                'description' => 'Could not finish the final steps',
            ], 500);
        }

        DB::commit();

        $transaction->refresh();
        return response()->json($this->paymentService->jsonify($transaction, false), 201);
    }

    public function getPaginatedTransactionList(Request $request)
    {
        $token = $this->getRequestToken($request);
        $includeRefound = $this->getIncludeRefounded($request);
        $page = $request->input('page', 1);
        if (!is_numeric($page))
            return response()->json([
                'error' => 'Invalid pagination page',
                'description' => 'The pagination page must be a number greater than 0',
            ], 400);
        $page = (int) $page;
        if ($page < 1) {
            return response()->json([
                'error' => 'Invalid pagination page',
                'description' => 'The pagination page must be 1 or more',
            ], 400);
        }
        $limit = $request->input('limit', 10);
        if (!is_numeric($limit))
            return response()->json([
                'error' => 'Invalid pagination limit',
                'description' => 'The pagination limit must be a number greater than 0',
            ], 400);
        $limit = min((int) $limit, 100);
        if ($limit < 1) {
            return response()->json([
                'error' => 'Invalid pagination limit',
                'description' => 'The pagination limit must be 1 or more',
            ], 400);
        }

        $paginated = Transaction::orderBy('id', 'desc')
            ->where('business_id', $token->business_id)
            ->paginate($limit, ['*'], 'page', $page);
        $transactions = collect($paginated->items())->map(function ($transaction) use ($includeRefound) {
            return $this->paymentService->jsonify($transaction, $includeRefound);
        })->all();

        return response()->json([
            'meta' => [
                'page' => $paginated->currentPage(),
                'retrieved' => count($transactions),
                'total' => $paginated->total(),
            ],
            'transactions' => $transactions,
        ], 200);
    }

    public function fulfillPendingTransaction(Request $request)
    {
        $transaction = $this->getRequestTransaction($request);

        if ($transaction->state !== TransactionStateType::Waiting) {
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
        return response()->json($this->paymentService->jsonify($transaction, false), 200);
    }

    public function getTransactionDetails(Request $request)
    {
        $includeRefound = $this->getIncludeRefounded($request);
        $transaction = $this->getRequestTransaction($request);

        return response()->json($this->paymentService->jsonify($transaction, $includeRefound), 200);
    }

    public function refoundTransaction(Request $request)
    {
        $transaction = self::getRequestTransaction($request);
        $includeRefound = self::getIncludeRefounded($request);
        if ($transaction->state !== TransactionStateType::Accepted) {
            return response()->json([
                'error' => 'Transaction not accepted',
                'description' => 'Only accepted transactions can be refounded',
            ], 400);
        }
        if ($transaction->isRefound())
            return response()->json([
                'error' => 'Transaction is refound',
                'description' => 'Only non refound transactions can be refounded',
            ], 400);

        if ($this->paymentService->transactionHasBeenRefounded($transaction->id)) {
            return response()->json([
                'error' => 'Transaction already refunded',
                'description' => 'This transaction already has been refounded',
            ], 400);
        }

        $concept = $request->json('concept');
        $receiptNumber = $request->json('receipt_number');

        DB::beginTransaction();
        $refound = $this->paymentService->createRefoundTransaction($transaction->id, $concept, $receiptNumber);
        if (!$refound) {
            DB::rollBack();
            return response()->json([
                'error' => 'Server error',
                'description' => 'Could not create refound',
            ], 500);
        }

        DB::commit();
        return response()->json($this->paymentService->jsonify($refound, $includeRefound));
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
