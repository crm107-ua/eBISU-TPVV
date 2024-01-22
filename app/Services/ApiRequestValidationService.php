<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ApiRequestValidationService
{
    public function validateRequestTransactionCreation(array $requestTransactionCreation): MessageBag
    {
        $errors = Validator::make($requestTransactionCreation, [
            'concept' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'receipt_number' => 'nullable|string|max:255',
            'payment' => 'array',
        ], [
            'concept.string' => 'The concept must be a string.',
            'concept.max' => 'The concept must not exceed :max characters.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a numeric value.',
            'amount.min' => 'The amount must be at least :min.',
            'receipt_number.string' => 'The receipt number must be a string.',
            'receipt_number.max' => 'The receipt number must not exceed :max characters.',
            'payment.array' => 'The payment field must be an object.',
        ])->errors();
        if (array_key_exists('payment', $requestTransactionCreation)) {
            $payment = $requestTransactionCreation['payment'];
            if (!is_array($payment))
                return $errors;
            $errors->merge($this->validatePaymentInformation($payment));
        }
        return $errors;
    }

    public function validatePaymentInformation(array $paymentInformation): MessageBag
    {
        $validator = Validator::make($paymentInformation, [
            'type' => 'required|in:paypal,credit_card',
            'values' => 'required|array',
        ], [
            'type.required' => 'The payment type is required.',
            'type.in' => 'The payment type must be either "paypal" or "credit_card".',
            'values.required' => 'The values field is required.',
            'values.array' => 'The values field must be an object.',
        ]);

        if ($validator->fails())
            return $validator->errors();

        $type = $paymentInformation['type'];
        if ($type === 'paypal') {
            return Validator::make($paymentInformation, [
                'values.paypal_user' =>  'required|string',
            ], [
                'values.paypal_user.required' => 'The PayPal user is required for type "paypal".',
                'values.paypal_user.required' => 'The PayPal user must be a string.',
            ])->errors()->merge($validator->errors());
        } else {
            return Validator::make($paymentInformation, [
                'values.credit_card_number' => 'required|string',
                'values.credit_card_expiration_month' => 'required|numeric|between:1,12',
                'values.credit_card_expiration_year' => 'required|string',
                'values.credit_card_csv' => 'required|numeric|between:0,999',
            ], [
                'values.credit_card_number.required' => 'The credit card number is required for type "credit_card".',
                'values.credit_card_expiration_month.required' => 'The credit card expiration month is required for type "credit_card".',
                'values.credit_card_expiration_month.numeric' => 'The credit card expiration month must be a number.',
                'values.credit_card_expiration_month.between' => 'The credit card expiration month must be between 1 and 12.',
                'values.credit_card_expiration_year.required' => 'The credit card expiration year is required for type "credit_card".',
                'values.credit_card_csv.required' => 'The credit card CSV is required for type "credit_card".',
                'values.credit_card_csv.numeric' => 'The credit card CSV must be a number.',
                'values.credit_card_csv.between' => 'The credit card CSV must be between 0 and 999.',
            ])->errors()->merge($validator->errors());
        }
    }

    public function validateRequestRefoundInformation(array $requestRefoundInformation): MessageBag
    {
        return Validator::make($requestRefoundInformation, [
            'concept' => 'nullable|string|max:255',
            'receipt_number' => 'nullable|string|max:255',
        ], [
            'concept.string' => 'The concept must be a string.',
            'concept.max' => 'The concept must not exceed :max characters.',
            'receipt_number.string' => 'The receipt number must be a string.',
            'receipt_number.max' => 'The receipt number must not exceed :max characters.',
        ])->errors();
    }
}
