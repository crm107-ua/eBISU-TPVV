<?php

namespace Tests\Unit;

use App\Models\ApiToken;
use App\Models\Business;
use App\Models\User;
use App\Services\ApiTokenService;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RequestHasTokenMiddlewareTest extends TestCase
{

    use RefreshDatabase;

    private $url = '/test/middleware/apiqequesthastoken';
    private $apiTokenService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->apiTokenService = new ApiTokenService();
        Route::middleware('api.token')->any($this->url, function () {
            return response()->json([
                'message' => 'Middleware let the request pass',
            ], 299);
        });
    }

    /**
     * @group api
     * @group middleware
     * @group has_token
     */
    public function test_valid_request_passes_the_middleware(): void
    {
        $apiToken = $this->createValidToken();

        $response = $this->getJson($this->url, [
            'authorization' => 'Bearer ' . $this->apiTokenService->encode($apiToken),
        ]);

        $response
            ->assertStatus(299)
            ->assertJson([
                'message' => 'Middleware let the request pass',
            ]);
    }

    /**
     * @group api
     * @group middleware
     * @group has_token
     */
    public function test_valid_request_passes_the_middleware_and_increments_counter(): void
    {
        $apiToken = $this->createValidToken();
        $encoded = $this->apiTokenService->encode($apiToken);
        $loopCount = 5;

        $apiToken = ApiToken::find($apiToken->id);
        $this->assertEquals(0, $apiToken->times_used);

        for ($i = 1; $i <= $loopCount; $i++) {
            $this->get($this->url, [
                'authorization' => 'Bearer ' . $encoded,
            ]);

            $apiToken = ApiToken::find($apiToken->id);
            $this->assertEquals($i, $apiToken->times_used);
        }
    }

    /**
     * @group api
     * @group middleware
     * @group has_token
     */
    public function test_request_without_header_rejected(): void
    {
        $response = $this->getJson($this->url);

        $response
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
                'error' => 'No token',
                'description' => 'You did not provide a token',
            ]);
    }

    /**
     * @group api
     * @group middleware
     * @group has_token
     */
    public function test_request_with_empty_header_rejected(): void
    {
        $response = $this->getJson($this->url, [
            'authorization' => '',
        ]);

        $response
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
                'error' => 'No token',
                'description' => 'You did not provide a token',
            ]);
    }

    /**
     * @group api
     * @group middleware
     * @group has_token
     */
    public function test_request_with_header_but_no_bearer_rejected(): void
    {
        $response = $this->getJson($this->url, [
            'authorization' => 'No bearer',
        ]);

        $response
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
                'error' => 'No token',
                'description' => 'You did not provide a token',
            ]);
    }

    /**
     * @group api
     * @group middleware
     * @group has_token
     */
    public function test_request_with_header_but_bearer_has_no_token_rejected(): void
    {
        $response = $this->getJson($this->url, [
            'authorization' => 'Bearer ',
        ]);

        $response
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
                'error' => 'No token',
                'description' => 'You did not provide a token',
            ]);
    }

    /**
     * @group api
     * @group middleware
     * @group has_token
     */
    public function test_request_with_header_but_bearer_is_not_token_rejected(): void
    {
        $response = $this->getJson($this->url, [
            'authorization' => 'Bearer noesuntoken',
        ]);

        $response
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
                'error' => 'Invalid token',
                'description' => 'The provided token is invalid',
            ]);
    }

    /**
     * @group api
     * @group middleware
     * @group has_token
     */
    public function test_request_with_header_but_bearer_token_has_wrong_secret_rejected(): void
    {
        $response = $this->getJson($this->url, [
            'authorization' => 'Bearer ' . JWT::encode(['id' => 1], 'testsecret', 'HS256'),
        ]);

        $response
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
                'error' => 'Invalid token',
                'description' => 'The provided token is invalid',
            ]);
    }

    /**
     * @group api
     * @group middleware
     * @group has_token
     */
    public function test_request_with_header_but_bearer_token_non_existing_id_rejected(): void
    {
        $response = $this->getJson($this->url, [
            'authorization' => 'Bearer ' . JWT::encode(['id' => 1], env('JWT_SECRET'), env('JWT_ALGO')),
        ]);

        $response
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
                'error' => 'Invalid token',
                'description' => 'The provided token does not exist',
            ]);
    }

    /**
     * @group api
     * @group middleware
     * @group has_token
     */
    public function test_request_with_header_but_bearer_is_expired_rejected(): void
    {
        $expiration = Carbon::now()->subDay();
        $apiToken = $this->createValidToken();
        $apiToken->expiration_date = $expiration;
        $this->assertTrue($apiToken->save());

        $response = $this->getJson($this->url, [
            'authorization' => 'Bearer ' . $this->apiTokenService->encode($apiToken),
        ]);

        $response
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
                'error' => 'Invalid token',
                'description' => 'The provided token expired on ' . $expiration->toIso8601String(),
            ]);
    }

    /**
     * @group api
     * @group middleware
     * @group has_token
     */
    public function test_request_with_header_but_bearer_is_invalidated_rejected(): void
    {
        $apiToken = $this->createValidToken();
        $apiToken->invalidated = true;
        $this->assertTrue($apiToken->save());

        $response = $this->getJson($this->url, [
            'authorization' => 'Bearer ' . $this->apiTokenService->encode($apiToken),
        ]);

        $response
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
                'error' => 'Invalid token',
                'description' => 'The provided token is invalidated',
            ]);
    }

    private function createValidToken()
    {
        $user = User::factory()->create();
        $business = Business::factory()->for($user)->create();
        $apiToken = ApiToken::factory()->for($business)->create();
        return $apiToken;
    }
}
