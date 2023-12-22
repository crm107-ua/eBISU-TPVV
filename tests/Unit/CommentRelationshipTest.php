<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Comment;
use App\Models\User;
use App\Models\Country;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\Business;
use App\Models\Attachment;

class CommentRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_comment_belongs_to_user(){
        $user = $this->createUser();
        $user->save();

        $ticket = $this->createTicket();
        $ticket->save();

        $attachment = new Attachment();
        $attachment->filename = 'Test Attachment';
        $attachment->upload_date = now();
        $attachment->save();

        $comment = new Comment();
        $comment->message = 'Test comment';
        $comment->sent_date = now();
        $comment->author()->associate($user);
        $comment->ticket()->associate($ticket);
        $comment->attachment()->associate($attachment);
        $comment->save();

        $this->assertEquals($user->id, $comment->author->id);
        $this->assertEquals($user->name, $comment->author->name);
        $this->assertEquals($comment->ticket->id, $ticket->id);
        $this->assertEquals($comment->attachment->id, $attachment->id);
        $this->assertEquals($comment->attachment->filename, $attachment->filename);
    }

    protected function createUser()
    {
        $user = new User();
        $user->name = 'Erik';
        $user->email = 'test@gmail.com';
        $user->password = bcrypt('password');
        $user->role = 'admin';
        $user->direction_direction = 'Calle de la piruleta';
        $user->direction_postal_code = '12345';
        $user->direction_poblation = 'Madrid';
        $user->country()->associate(Country::find(1));
        return $user;
    }

    protected function createTicket() {
        $transaction = $this->createTransaction();
        $transaction->save();

        $ticket = new Ticket();
        $ticket->title = 'Test Ticket';
        $ticket->description = 'Test Description';
        $ticket->state = 'open';
        $ticket->priority = 1;
        $ticket->creation_date = now();
        $ticket->transaction()->associate($transaction);
        return $ticket;
    }

    protected function createBusiness()
    {
        $user = new User();
        $user->name = 'Erik';
        $user->email = 'erik@gmail.com';
        $user->password = bcrypt('password');
        $user->role = 'admin';
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

    protected function createTransaction() {
        $business = $this->createBusiness();
        $business->save();

        $payment = new Payment();
        $payment->type = 'credit_card';
        $payment->credit_card_number = '1234567812345678';
        $payment->credit_card_month_of_expiration = '12';
        $payment->credit_card_year_of_expiration = '2025';
        $payment->credit_card_csv = '123';
        $payment->save();

        $transaction = new Transaction();
        $transaction->concept = 'Test Transaction';
        $transaction->amount = 100;
        $transaction->state = 'waiting';
        $transaction->emision_date = now();
        $transaction->payment()->associate($payment);
        $transaction->business()->associate($business);
        return $transaction;
    }
}
