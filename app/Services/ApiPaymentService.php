<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ApiPaymentService
{
    public function validateRequestTransactionCreation(array $requestTransactionCreation): MessageBag
    {
        $errors = Validator::make($requestTransactionCreation, [
            'concept' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'receipt_number' => 'nullable|string|max:255',
        ])->errors();
        if (array_key_exists('payment', $requestTransactionCreation)) {
            $errors->merge($this->validatePaymentInformation($requestTransactionCreation['payment']));
        }
        return $errors;
    }

    public function validatePaymentInformation(array $paymentInformation): MessageBag
    {
        $type = $paymentInformation['type'];
        return Validator::make($paymentInformation, [
            'type' => 'required|in:paypal,credit_card',
            'values' => 'required|array',
            'values.paypal_user' => $type == 'paypal' ? 'required|string' : '',
            'values.credit_card_number' => $type == 'credit_card' ? 'required|string' : '',
            'values.credit_card_expiration_month' => $type == 'credit_card' ? 'required|numeric|between:1,12' : '',
            'values.credit_card_expiration_year' => $type == 'credit_card' ? 'required|string' : '',
            'values.credit_card_csv' => $type == 'credit_card' ? 'required|numeric|between:0,999' : '',
        ], [
            'type.required' => 'The payment type is required.',
            'type.in' => 'The payment type must be either "paypal" or "credit_card".',
            'values.required' => 'The values field is required.',
            'values.paypal_user.required' => 'The PayPal user is required for type "paypal".',
            'values.credit_card_number.required' => 'The credit card number is required for type "credit_card".',
            'values.credit_card_expiration_month.required' => 'The credit card expiration month is required for type "credit_card".',
            'values.credit_card_expiration_month.numeric' => 'The credit card expiration month must be a number.',
            'values.credit_card_expiration_month.between' => 'The credit card expiration month must be between 1 and 12.',
            'values.credit_card_expiration_year.required' => 'The credit card expiration year is required for type "credit_card".',
            'values.credit_card_csv.required' => 'The credit card CSV is required for type "credit_card".',
            'values.credit_card_csv.numeric' => 'The credit card CSV must be a number.',
            'values.credit_card_csv.between' => 'The credit card CSV must be between 0 and 999.',
        ])->errors();
    }
}
