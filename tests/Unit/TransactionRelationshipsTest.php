<?php

namespace Tests\Unit;

use App\Enums\PaymentType;
use App\Enums\TransactionStateType;
use App\Enums\UserRole;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\Business;
use App\Models\User;
use App\Models\Country;

class TransactionRelationshipsTest extends TestCase
{
    use RefreshDatabase;

    public function test_transaction_has_payment() {
        $business = $this->createBusiness();
        $business->save();

        $payment = new Payment();
        $payment->type = PaymentType::CreditCard;
        $payment->credit_card_number = '1234567812345678';
        $payment->credit_card_month_of_expiration = '12';
        $payment->credit_card_year_of_expiration = '2025';
        $payment->credit_card_csv = '123';
        $payment->save();

        $transaction = new Transaction();
        $transaction->concept = 'Test Transaction';
        $transaction->amount = 100;
        $transaction->state = TransactionStateType::Waiting;
        $transaction->emision_date = now();
        $transaction->payment()->associate($payment);
        $transaction->business()->associate($business);
        $transaction->save();

        $this->assertEquals($payment->id, $transaction->payment->id);
        $this->assertEquals($payment->type, $transaction->payment->type);
        $this->assertEquals($transaction->id, $payment->transaction->id);
        $this->assertEquals($business->id, $transaction->business->id);
        $this->assertEquals($transaction->id, $business->transactions->first()->id);
    }

    public function test_refund_transaction() {
        $business = $this->createBusiness();
        $business->save();

        $payment = new Payment();
        $payment->type =PaymentType::CreditCard;
        $payment->credit_card_number = '1234567812345678';
        $payment->credit_card_month_of_expiration = '12';
        $payment->credit_card_year_of_expiration = '2025';
        $payment->credit_card_csv = '123';
        $payment->save();

        $transaction = new Transaction();
        $transaction->concept = 'Test Transaction';
        $transaction->amount = 100;
        $transaction->state = TransactionStateType::Waiting;
        $transaction->emision_date = now();
        $transaction->payment_id = $payment->id;
        $transaction->business_id = $business->id;
        $transaction->save();


        $refundTransaction = new Transaction();
        $refundTransaction->concept = 'Refund Transaction';
        $refundTransaction->amount = -100;
        $refundTransaction->state = TransactionStateType::Accepted;
        $refundTransaction->emision_date = now();
        $refundTransaction->finished_date = now();
        $refundTransaction->finalize_reason = 1;
        $refundTransaction->business_id = $business->id;
        $refundTransaction->payment_id = $payment->id;
        $refundTransaction->save();
        $refundTransaction->refoundsTo()->save($transaction);

        $this->assertEquals($refundTransaction->id, $transaction->refoundedBy()->first()->id);
        $this->assertEquals($transaction->id, $refundTransaction->refoundsTo()->first()->id);
    }

    protected function createBusiness()
    {
        $user = new User();
        $user->name = 'Erik';
        $user->email = 'erik@gmail.com';
        $user->password = bcrypt('password');
        $user->role = UserRole::Technician;
        $user->direction_direction = 'Calle de la piruleta';
        $user->direction_postal_code = '12345';
        $user->direction_poblation = 'Madrid';

        $user->country()->associate(Country::find(1));
        $user->save();

        $business = new Business();
        $business->cif = '12345678A';
        $business->registration_date = now();
        $business->discharge_date = now();
        $business->balance = 0;
        $business->contact_info_name = 'Test Business';
        $business->contact_info_phone_number = '123456789';
        $business->contact_info_email = 'test@mail.com';
        $business->user()->associate($user);
        return $business;
    }
}
