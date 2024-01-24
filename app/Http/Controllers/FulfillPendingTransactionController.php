<?php

namespace App\Http\Controllers;

use App\Enums\PaymentType;
use App\Enums\TransactionStateType;
use App\Models\Transaction;
use App\Services\ApiPaymentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FulfillPendingTransactionController extends Controller
{

    private $paymentService;

    public function __construct()
    {
        $this->paymentService = new ApiPaymentService();
    }

    public function getPaymentForm(Request $request, $transactionId)
    {
        $transaction = Transaction::find($transactionId);
        if (!$transaction) {
            return view('payment.transactionNotFound');
        }

        if ($transaction->state !== TransactionStateType::Waiting) {
            return view('payment.transactionFinished');
        }

        return view('payment.paymentForm', [
            'business' => $transaction->business,
            'transaction' => $transaction,
            'timeoutDate' => $transaction->emision_date->addSeconds((int) env('TRANSACTION_TIMEOUT')),
        ]);
    }

    public function postPaymentForm(Request $request, $transactionId)
    {
        $transaction = Transaction::find($transactionId);
        if (!$transaction) {
            return view('payment.transactionNotFound');
        }


        $request->validate([
            'paymentMethod' => 'required|string|in:paypal,credit-card',
        ]);

        if($request->input('paymentMethod') === 'paypal') {
            $request->validate([
                'paypal_username' => 'required|string|max:255',
            ]);
        } else {
            $request->validate([
                'credit_card_number' => 'required|string|max:255',
                'credit_card_month_of_expiration' => 'required|numeric|between:1,12',
                'credit_card_year_of_expiration' => 'required|numeric|between:1970,9999',
                'credit_card_csv' => 'required|numeric|between:0,999',
            ]);
        }

        $paymentValues = [
            'values' => [],
        ];
        if ($request->input('paymentMethod') === 'paypal') {
            $paymentValues['type'] = PaymentType::Paypal->value;
            $paymentValues['values']['paypal_user'] = $request->input('paypal_username');
        } else {
            $paymentValues['type'] = PaymentType::CreditCard->value;
            $paymentValues['values']['credit_card_number'] = $request->input('credit_card_number');
            $paymentValues['values']['credit_card_expiration_month'] = $request->input('credit_card_month_of_expiration');
            $paymentValues['values']['credit_card_expiration_year'] = $request->input('credit_card_year_of_expiration');
            $paymentValues['values']['credit_card_csv'] = $request->input('credit_card_csv');
        }

        DB::beginTransaction();
        $payment = $this->paymentService->savePaymentMethod($paymentValues);
        if (!$payment) {
            DB::rollBack();
            return view('payment.serverError', [
                'transaction' => $transaction,
            ]);
        }

        $finalized = $this->paymentService->finalizePendingTransaction($transaction->id, $payment->id);
        if(!$finalized) {
            DB::rollBack();
            return view('payment.serverError', [
                'transacion' => $transaction,
            ]);
        }

        DB::commit();
        return redirect()->route('payment.get.result', [
            'id' => $transaction->id,
        ]);
    }

    public function getResultView(Request $request, $transactionId)
    {
        $transaction = Transaction::find($transactionId);
        if (!$transaction) {
            return view('payment.transactionNotFound');
        }
        return view('payment.transactionResult', [
            'transaction' => $transaction,
        ]);
    }
}
