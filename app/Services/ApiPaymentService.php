<?php

namespace App\Services;

use App\Enums\FinalizeReason;
use App\Enums\PaymentType;
use App\Enums\TransactionStateType;
use App\Models\Payment;
use App\Models\Transaction;
use Carbon\Carbon;

class ApiPaymentService
{

    public function createNewTransaction($businessId, $amount, $concept, $receiptNumber): ?Transaction
    {
        $transaction = new Transaction([
            'concept' => $concept,
            'receipt_number' => $receiptNumber,
            'amount' => $amount,
            'business_id' => $businessId,
            'emision_date' => Carbon::now(),
            'state' => TransactionStateType::Waiting,
        ]);
        if (!$transaction->save())
            return null;

        /**
         * @todo START TIMER
         */
        return $transaction;
    }

    public function savePaymentMethod(array $paymentValues): ?Payment
    {
        $payment = null;
        if ($paymentValues['type'] === PaymentType::Paypal->value) {
            $payment = new Payment([
                'type' => PaymentType::Paypal,
                'paypal_user' => $paymentValues['values']['paypal_user'],
            ]);
        } else {
            $payment = new Payment([
                'type' => PaymentType::CreditCard,
                'credit_card_number' => $paymentValues['values']['credit_card_number'],
                'credit_card_month_of_expiration' => $paymentValues['values']['credit_card_expiration_month'],
                'credit_card_year_of_expiration' => $paymentValues['values']['credit_card_expiration_year'],
                'credit_card_csv' => $paymentValues['values']['credit_card_csv'],
            ]);
        }
        if (!$payment->save())
            return null;
        return $payment;
    }

    public function finalizePendingTransaction($transactionId, $paymentId, ?FinalizeReason $finalizeReason = null): bool
    {
        if (!$transactionId)
            return false;
        $transaction = Transaction::find($transactionId);
        if (!$transaction)
            return false;
        if ($transaction->state != TransactionStateType::Waiting)
            return false;

        $transaction->finished_date = Carbon::now();

        if ($finalizeReason) {
            //We make it end for a specific reason
            $transaction->finalize_reason = $finalizeReason;
        } else {
            // Randomly make the transaction successfull or not
            $willSucceed = ((float) rand() / (float) getrandmax()) <= (float) env('TRANSACTION_SUCCESS_RATE');
            if ($willSucceed) {
                $transaction->finalize_reason = FinalizeReason::OK;
            } else {
                // The transaction failed, we have to choose why
                if ($paymentId) {
                    $possibleOptions = [FinalizeReason::INSUFFICIENT_BALANCE, FinalizeReason::INVALID_PAYMENT_INFORMATION];
                    $transaction->finalize_reason = $possibleOptions[array_rand($possibleOptions)];
                } else {
                    // There is no payment information so it can only be CANCELLED (TIMEOUT must be reserved for actual time outs)
                    $transaction->finalize_reason = FinalizeReason::CANCELLED;
                }
            }
        }

        if ($transaction->finalize_reason->hasAssociatedPaymentMethod()) {
            if (!$paymentId)
                return false;
            $payment = Payment::find($paymentId);
            if (!$payment)
                return false;
            $transaction->payment()->associate($payment);
        }

        $transaction->state = $transaction->finalize_reason->getReasonState();

        if (!$transaction->save())
            return false;
        return true;
    }
}
