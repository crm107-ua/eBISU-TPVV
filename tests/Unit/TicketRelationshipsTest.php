<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Ticket;
use App\Models\Comment;
use App\Models\User;
use App\Models\Country;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\Business;
use App\Models\Attachment;
use App\Models\Technician;

class TicketRelationshipsTest extends TestCase
{
    use RefreshDatabase;

    public function test_ticket_transaction_relationship()
    {
        $transaction = $this->createTransaction();
        $transaction->save();

        $ticket = new Ticket();
        $ticket->title = 'Test Ticket';
        $ticket->description = 'Test Description';
        $ticket->creation_date = now();
        $ticket->state = 'closed';
        $ticket->priority = 1;
        $ticket->transaction()->associate($transaction);
        $ticket->save();

        $this->assertEquals($ticket->transaction->id, $transaction->id);
        $this->assertEquals($ticket->transaction->concept, $transaction->concept);
    }

    public function test_ticket_comments_relationship()
    {
        $transaction = $this->createTransaction();
        $transaction->save();

        $ticket = new Ticket();
        $ticket->title = 'Test Ticket';
        $ticket->description = 'Test Description';
        $ticket->creation_date = now();
        $ticket->state = 'closed';
        $ticket->priority = 1;
        $ticket->transaction()->associate($transaction);
        $ticket->save();

        $author = new User();
        $author->name = 'Erik';
        $author->email = 'author@maol.com';
        $author->password = bcrypt('password');
        $author->role = 'admin';
        $author->direction_direction = 'Calle de la piruleta';
        $author->direction_postal_code = '12345';
        $author->direction_poblation = 'Madrid';
        $author->country()->associate(Country::find(1));
        $author->save();

        $comment = new Comment();
        $comment->message = 'Test comment';
        $comment->sent_date = now();
        $comment->ticket()->associate($ticket);
        $comment->author()->associate($author);
        $comment->save();

        $this->assertEquals($ticket->comments->first()->id, $comment->id);
        $this->assertEquals($ticket->comments->first()->message, $comment->message);
    }

    public function test_ticket_and_technician_relationship()
     {
        $transaction = $this->createTransaction();
        $transaction->save();

        $technician = $this->createTechnician();
        $technician->save();

         $ticket = new Ticket();
         $ticket->title = 'Test Ticket';
         $ticket->description = 'Test Description';
         $ticket->creation_date = now();
         $ticket->state = 'closed';
         $ticket->priority = 1;
         $ticket->transaction()->associate($transaction);
         $ticket->technitian()->associate($technician);
         $ticket->save();

        $this->assertEquals($ticket->technitian->id, $technician->id);
        $this->assertEquals($ticket->technitian->user->name, $technician->user->name);
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

        $payment = $this->createPayment();
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

    protected function createPayment()
    {
        $payment = new Payment();
        $payment->type = 'credit_card';
        $payment->credit_card_number = '1234567812345678';
        $payment->credit_card_month_of_expiration = '12';
        $payment->credit_card_year_of_expiration = '2025';
        $payment->credit_card_csv = '123';
        return $payment;
    }

    protected function createTechnician()
    {
        $technician = new User();
        $technician->name = 'Erik';
        $technician->email = 'tech@mail.com';
        $technician->password = bcrypt('password');
        $technician->role = 'technician';
        $technician->direction_direction = 'Calle de la piruleta';
        $technician->direction_postal_code = '12345';
        $technician->direction_poblation = 'Madrid';
        $technician->country()->associate(Country::find(1));
        $technician->save();

        $tech = new Technician();
        $tech->user()->associate($technician);
        return $tech;
    }
}
