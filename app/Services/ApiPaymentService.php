<?php

namespace App\Services;

use App\Enums\FinalizeReason;
use App\Enums\PaymentType;
use App\Enums\TransactionStateType;
use App\Jobs\TimeoutTransactionFulfillment;
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

        $timeoutJob = new TimeoutTransactionFulfillment($transaction->id);
        $dispatchTime = Carbon::now()->addSeconds((int) env('TRANSACTION_TIMEOUT'));
        dispatch($timeoutJob)->delay($dispatchTime);

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

        if ($transaction->state === TransactionStateType::Accepted) {
            $business = $transaction->business;
            $business->balance = $business->balance + $transaction->amount;
            if (!$business->save())
                return false;
        }

        return true;
    }

    public function createRefoundTransaction($toBeRefoundedId, $concept, $receiptNumber): ?Transaction
    {
        if (!$toBeRefoundedId)
            return null;
        $toBeRefounded = Transaction::find($toBeRefoundedId);
        if (!$toBeRefounded)
            return null;
        if ($toBeRefounded->state !== TransactionStateType::Accepted)
            return null;
        if ($toBeRefounded->isRefound())
            return null;

        $business = $toBeRefounded->business;

        if ($toBeRefounded->amount > $business->balance) {
            $refound = new Transaction([
                'concept' => $concept,
                'receipt_number' => $receiptNumber,
                'amount' => $toBeRefounded->amount * -1,
                'state' => TransactionStateType::Cancelled,
                'emision_date' => Carbon::now(),
                'finished_date' => Carbon::now(),
                'finalize_reason' => FinalizeReason::INSUFFICIENT_BALANCE,
                'refounds_id' => $toBeRefounded->id,
                'business_id' => $business->id,
                'payment_id' => $toBeRefounded->payment_id,
            ]);
            if (!$refound->save())
                return null;
            return $refound;
        }

        $refound = new Transaction([
            'concept' => $concept,
            'receipt_number' => $receiptNumber,
            'amount' => $toBeRefounded->amount * -1,
            'state' => TransactionStateType::Accepted,
            'emision_date' => Carbon::now(),
            'finished_date' => Carbon::now(),
            'finalize_reason' => FinalizeReason::OK,
            'refounds_id' => $toBeRefounded->id,
            'business_id' => $business->id,
            'payment_id' => $toBeRefounded->payment_id,
        ]);
        if (!$refound->save())
            return null;

        $business->balance = $business->balance + $refound->amount;
        if (!$business->save())
            return null;

        return $refound;
    }

    public function transactionHasBeenRefounded($transactionId): bool
    {
        return Transaction::where('refounds_id', $transactionId)
            ->where('state', TransactionStateType::Accepted)
            ->exists();
    }

    public function jsonify(Transaction $transaction, $includeRefound = false): ?array
    {
        if (!$transaction) return null;

        $json = [
            'id' => $transaction->id,
            'amount' => $transaction->amount,
            'state' => $transaction->state->getApiName(),
            'emision_date' => $this->formatDate($transaction->emision_date),
        ];

        if ($transaction->concept)
            $json['concept'] = $transaction->concept;

        if ($transaction->receipt_number)
            $json['concept'] = $transaction->receipt_number;

        if ($transaction->state != TransactionStateType::Waiting) {
            $json['finalized_date'] = $this->formatDate($transaction->finished_date);
            $json['finalized_reason'] = $transaction->finalize_reason->getApiMessage();
        }

        if ($transaction->refounds_id) {
            if ($includeRefound) {
                $refounded = Transaction::find($transaction->refounds_id);
                $json['refounds'] = $this->jsonify($refounded);
            } else {
                $json['refounds'] = $transaction->refounds_id;
            }
        }

        return $json;
    }

    private function formatDate($date)
    {
        return Carbon::parse($date)->toIso8601String();
    }
}
