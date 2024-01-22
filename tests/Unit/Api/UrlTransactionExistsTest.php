<?php

namespace Tests\Unit\Api;

use App\Enums\TransactionStateType;
use App\Models\Business;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * @group api
 * @group middleware
 * @group url_transaction
 */
class UrlTransactionExistsTest extends TestCase
{
    use RefreshDatabase;

    private $url = '/test/middleware/transactionexists/';

    /**
     * @var User
     */
    private $user;
    /**
     * @var Business
     */
    private $business;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->business = Business::factory()->for($this->user)->create();

        Route::middleware('api.transaction.url')->any($this->url . '{id}', function () {
            return response()->json([
                'message' => 'Middleware let the request pass',
            ], 299);
        });
    }

    public function test_transaction_id_invalid_fails(): void
    {
        $this->getJson($this->url . 'a')
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'error' => 'Invalid request',
                'description' => 'The id must be an integer',
            ]);
        $this->getJson($this->url . 'inf')
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'error' => 'Invalid request',
                'description' => 'The id must be an integer',
            ]);
    }

    public function test_transaction_does_not_exist(): void
    {
        $this->getJson($this->url . '1')
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJson([
                'error' => 'Transaction not found',
                'description' => "There is no transaction with id '1'",
            ]);
        $this->getJson($this->url . '-1')
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJson([
                'error' => 'Transaction not found',
                'description' => "There is no transaction with id '-1'",
            ]);
    }

    public function test_waiting_transaction_requested_ok(): void
    {
        $transaction = new Transaction([
            'amount' => 101,
            'state' => TransactionStateType::Waiting,
            'emision_date' => Carbon::now(),
            'business_id' => $this->business->id,
        ]);
        $transaction->save();

        $this->getJson($this->url . $transaction->id)
            ->assertStatus(299);
    }

}
