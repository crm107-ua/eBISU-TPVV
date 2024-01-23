<?php

namespace Tests\Feature\Api;

use App\Models\ApiToken;
use App\Models\Business;
use App\Models\Transaction;
use App\Models\User;
use App\Services\ApiPaymentService;
use App\Services\ApiTokenService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * @group api
 * @group endpoint
 * @group paginated_transactions
 */
class GetPaginatedTransactionListEndpointTest extends TestCase
{
    use RefreshDatabase;

    private $url = '/api/transactions';

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

    public function test_get_invalid_page(): void
    {
        $this->getJson($this->url . '?page=0', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'error' => 'Invalid pagination page',
                'description' => 'The pagination page must be 1 or more',
            ]);
        $this->getJson($this->url . '?page=-1', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'error' => 'Invalid pagination page',
                'description' => 'The pagination page must be 1 or more',
            ]);
        $this->getJson($this->url . '?page=aa', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'error' => 'Invalid pagination page',
                'description' => 'The pagination page must be a number greater than 0',
            ]);
        $this->getJson($this->url . '?page=', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'error' => 'Invalid pagination page',
                'description' => 'The pagination page must be a number greater than 0',
            ]);
    }

    public function test_get_invalid_limit(): void
    {
        $this->getJson($this->url . '?limit=0', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'error' => 'Invalid pagination limit',
                'description' => 'The pagination limit must be 1 or more',
            ]);
        $this->getJson($this->url . '?limit=-1', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'error' => 'Invalid pagination limit',
                'description' => 'The pagination limit must be 1 or more',
            ]);
        $this->getJson($this->url . '?limit=aa', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'error' => 'Invalid pagination limit',
                'description' => 'The pagination limit must be a number greater than 0',
            ]);
        $this->getJson($this->url . '?limit=', $this->headers)
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'error' => 'Invalid pagination limit',
                'description' => 'The pagination limit must be a number greater than 0',
            ]);
    }

    public function test_get_list_with_no_transactions(): void
    {
        $this->getJson($this->url, $this->headers)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson([
                'meta' => [
                    'page' => 1,
                    'retrieved' => 0,
                    'total' => 0,
                ],
                'transactions' => [],
            ]);
    }

    public function test_get_list_with_one_transaction(): void
    {
        $transaction = Transaction::factory()->withBusiness($this->business)->create();

        $this->getJson($this->url, $this->headers)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson([
                'meta' => [
                    'page' => 1,
                    'retrieved' => 1,
                    'total' => 1,
                ],
                'transactions' => [
                    $transaction->jsonify(),
                ],
            ]);
    }
}
