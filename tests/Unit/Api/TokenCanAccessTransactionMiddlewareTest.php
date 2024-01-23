<?php

namespace Tests\Unit\Api;

use App\Enums\TransactionStateType;
use App\Models\ApiToken;
use App\Models\Business;
use App\Models\Transaction;
use App\Models\User;
use App\Services\ApiTokenService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * @group api
 * @group middleware
 * @group token_access
 */
class TokenCanAccessTransactionMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    private $url = '/test/middleware/tokenaccess/';

    /**
     * @var User
     */
    private $user;
    /**
     * @var Business
     */
    private $business;
    /**
     * @var ApiToken
     */
    private $token;
    /**
     * @var array
     */
    private $headers;

    protected function setUp(): void
    {
        parent::setUp();
        $service = new ApiTokenService();

        $this->user = User::factory()->create();
        $this->business = Business::factory()->for($this->user)->create();
        $this->token = ApiToken::factory()->for($this->business)->create();
        $this->headers = [
            'authorization' => 'Bearer ' . $service->encode($this->token),
        ];

        Route::middleware(['api.token', 'api.transaction.url', 'api.transaction.access'])->any($this->url . '{id}', function () {
                return response()->json([
                    'message' => 'Middleware let the request pass',
                ], 299);
            });
    }

    public function test_transaction_requested_does_not_belong_to_business_rejects(): void
    {
        $user = User::factory()->create();
        $business = Business::factory()->for($user)->create();
        $transaction = new Transaction([
            'amount' => 1,
            'state' => TransactionStateType::Waiting,
            'emision_date' => now(),
            'business_id' => $business->id,
        ]);
        $transaction->save();

        $this->getJson($this->url . $transaction->id, $this->headers)
            ->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertJson([
                'error' => 'Not allowed',
                'description' => 'You can not get transactions from other business',
            ]);
    }

    public function test_transaction_requested_belongs_to_business_ok(): void
    {
        $transaction = new Transaction([
            'amount' => 1,
            'state' => TransactionStateType::Waiting,
            'emision_date' => now(),
            'business_id' => $this->business->id,
        ]);
        $transaction->save();
        $this->getJson($this->url . $transaction->id, $this->headers)
            ->assertStatus(299);
    }
}
