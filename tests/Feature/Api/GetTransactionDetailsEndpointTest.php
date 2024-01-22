<?php

namespace Tests\Feature\Api;

use App\Enums\FinalizeReason;
use App\Enums\TransactionStateType;
use App\Models\ApiToken;
use App\Models\Business;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use App\Services\ApiTokenService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class GetTransactionDetailsEndpointTest extends TestCase
{
    use RefreshDatabase;

    private $url = '/api/transactions/';

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

    public function setUp(): void
    {
        parent::setUp();
        $service = new ApiTokenService();

        $this->user = User::factory()->create();
        $this->business = Business::factory()->for($this->user)->create();
        $this->token = ApiToken::factory()->for($this->business)->create();
        $this->headers = [
            'authorization' => 'Bearer ' . $service->encode($this->token),
        ];
    }

    /**
     * @group api
     * @group endpoint
     * @group transaction_details
     */
    public function test_invalid_includeRefound_fails(): void
    {
        $this->getJson($this->url . '1?includeRefound=', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->getJson($this->url . '1?includeRefound=1', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->getJson($this->url . '1?includeRefound=0', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->getJson($this->url . '1?includeRefound=TRUE', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->getJson($this->url . '1?includeRefound=FALSE', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->getJson($this->url . '1?includeRefound=aaa', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    /**
     * @group api
     * @group endpoint
     * @group transaction_details
     */
    public function test_transaction_id_invalid_fails(): void
    {
        $this->getJson($this->url . 'a', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'error' => 'Invalid request',
                'description' => 'The id must be an integer',
            ]);
        $this->getJson($this->url . 'inf', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'error' => 'Invalid request',
                'description' => 'The id must be an integer',
            ]);
    }

    /**
     * @group api
     * @group endpoint
     * @group transaction_details
     */
    public function test_transaction_does_not_exist(): void
    {
        $this->getJson($this->url . '1', $this->headers)
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJson([
                'error' => 'Transaction not found',
                'description' => 'The requested transaction does not exist',
            ]);
        $this->getJson($this->url . '-1', $this->headers)
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJson([
                'error' => 'Transaction not found',
                'description' => 'The requested transaction does not exist',
            ]);
    }

    /**
     * @group api
     * @group endpoint
     * @group transaction_details
     */
    public function test_transaction_requested_does_not_belong_to_business_rejects(): void
    {
        $user = User::factory()->create();
        $business = Business::factory()->for($user)->create();
        $transaction = new Transaction([
            'amount' => 1,
            'state' => TransactionStateType::Waiting,
            'emision_date' => now(),
            'business_id' => $business->id,
            'payment_id' => Payment::factory()->create()->id,
        ]);
        $transaction->save();

        $this->getJson($this->url . $transaction->id, $this->headers)
            ->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertJson([
                'error' => 'Not allowed',
                'description' => 'You can not get transactions from other business',
            ]);
    }

    /**
     * @group api
     * @group endpoint
     * @group transaction_details
     */
    public function test_waiting_transaction_requested_ok(): void
    {
        $emission = now();
        $transaction = new Transaction([
            'amount' => 101,
            'state' => TransactionStateType::Waiting,
            'emision_date' => $emission,
            'business_id' => $this->business->id,
        ]);
        $transaction->save();

        $this->getJson($this->url . $transaction->id, $this->headers)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson([
                'id' => $transaction->id,
                'amount' => $transaction->amount,
                'state' => TransactionStateType::Waiting->getApiName(),
                'emision_date' => $emission->toIso8601String(),
            ]);
    }

    /**
     * @group api
     * @group endpoint
     * @group transaction_details
     */
    public function test_acepted_transaction_requested_ok(): void
    {
        $emission = now()->subDay();
        $finalizeDate = $emission->addMinutes(5);
        $transaction = new Transaction([
            'amount' => 101,
            'state' => TransactionStateType::Accepted,
            'emision_date' => $emission,
            'finalize_reason' => FinalizeReason::OK,
            'finished_date' => $finalizeDate,
            'business_id' => $this->business->id,
            'payment_id' => Payment::factory()->create()->id,
        ]);
        $transaction->save();

        $this->getJson($this->url . $transaction->id, $this->headers)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson([
                'id' => $transaction->id,
                'amount' => $transaction->amount,
                'state' => TransactionStateType::Accepted->getApiName(),
                'emision_date' => $emission->toIso8601String(),
                'finalized_reason' => FinalizeReason::OK->getApiMessage(),
                'finalized_date' => $finalizeDate->toIso8601String(),
            ]);
    }

    /**
     * @group api
     * @group endpoint
     * @group transaction_details
     */
    public function test_rejected_transaction_requested_ok(): void
    {
        $emission = now()->subDay();
        $finalizeDate = $emission->addMinutes(5);
        $finalizeReason = FinalizeReason::getReasonsFor(TransactionStateType::Cancelled)[array_rand(FinalizeReason::getReasonsFor(TransactionStateType::Cancelled))];
        $transaction = new Transaction([
            'amount' => 101,
            'state' => TransactionStateType::Cancelled,
            'emision_date' => $emission,
            'finalize_reason' => $finalizeReason,
            'finished_date' => $finalizeDate,
            'business_id' => $this->business->id,
            'payment_id' => Payment::factory()->create()->id,
        ]);
        $transaction->save();

        $this->getJson($this->url . $transaction->id, $this->headers)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson([
                'id' => $transaction->id,
                'amount' => $transaction->amount,
                'state' => TransactionStateType::Cancelled->getApiName(),
                'emision_date' => $emission->toIso8601String(),
                'finalized_reason' => $finalizeReason->getApiMessage(),
                'finalized_date' => $finalizeDate->toIso8601String(),
            ]);
    }

    /**
     * @group api
     * @group endpoint
     * @group transaction_details
     */
    public function test_acepted_transaction_with_refound_no_embeded_requested_ok(): void
    {
        $emission = now()->subDay();
        $finalizeDate = $emission->addMinutes(5);
        $refoundEmission = $finalizeDate->addMinutes(5);
        $refoundFinalizeDate = $refoundEmission;
        $paymentId = Payment::factory()->create()->id;
        $transaction = new Transaction([
            'amount' => 101.5,
            'state' => TransactionStateType::Accepted,
            'emision_date' => $emission,
            'finalize_reason' => FinalizeReason::OK,
            'finished_date' => $finalizeDate,
            'business_id' => $this->business->id,
            'payment_id' => $paymentId,
        ]);
        $transaction->save();
        $refound = new Transaction([
            'amount' => 101,
            'state' => TransactionStateType::Accepted,
            'emision_date' => $refoundEmission,
            'finalize_reason' => FinalizeReason::OK,
            'finished_date' => $refoundFinalizeDate,
            'business_id' => $this->business->id,
            'payment_id' => $paymentId,
            'refounds_id' => $transaction->id,
        ]);
        $refound->save();

        $this->getJson($this->url . $refound->id, $this->headers)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson([
                'id' => $refound->id,
                'amount' => $refound->amount,
                'state' => TransactionStateType::Accepted->getApiName(),
                'emision_date' => $refoundEmission->toIso8601String(),
                'finalized_reason' => FinalizeReason::OK->getApiMessage(),
                'finalized_date' => $refoundFinalizeDate->toIso8601String(),
                'refounds' => $transaction->id,
            ]);
    }

    /**
     * @group api
     * @group endpoint
     * @group transaction_details
     */
    public function test_acepted_transaction_with_refound_embeded_requested_ok(): void
    {
        $emission = now()->subDay();
        $finalizeDate = $emission->addMinutes(5);
        $refoundEmission = $finalizeDate->addMinutes(5);
        $refoundFinalizeDate = $refoundEmission;
        $paymentId = Payment::factory()->create()->id;
        $transaction = new Transaction([
            'amount' => 101.5,
            'state' => TransactionStateType::Accepted,
            'emision_date' => $emission,
            'finalize_reason' => FinalizeReason::OK,
            'finished_date' => $finalizeDate,
            'business_id' => $this->business->id,
            'payment_id' => $paymentId,
        ]);
        $transaction->save();
        $refound = new Transaction([
            'amount' => 101,
            'state' => TransactionStateType::Accepted,
            'emision_date' => $refoundEmission,
            'finalize_reason' => FinalizeReason::OK,
            'finished_date' => $refoundFinalizeDate,
            'business_id' => $this->business->id,
            'payment_id' => $paymentId,
            'refounds_id' => $transaction->id,
        ]);
        $refound->save();

        $this->getJson($this->url . $refound->id . '?includeRefound=true', $this->headers)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson([
                'id' => $refound->id,
                'amount' => $refound->amount,
                'state' => TransactionStateType::Accepted->getApiName(),
                'emision_date' => $refoundEmission->toIso8601String(),
                'finalized_reason' => FinalizeReason::OK->getApiMessage(),
                'finalized_date' => $refoundFinalizeDate->toIso8601String(),
                'refounds' => [
                    'id' => $transaction->id,
                    'amount' => $transaction->amount,
                    'state' => TransactionStateType::Accepted->getApiName(),
                    'emision_date' => $emission->toIso8601String(),
                    'finalized_reason' => FinalizeReason::OK->getApiMessage(),
                    'finalized_date' => $finalizeDate->toIso8601String(),
                ],
            ]);
    }
}
