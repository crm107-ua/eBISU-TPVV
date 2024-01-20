<?php

namespace Tests\Unit;

use App\Enums\UserRole;
use App\Models\ApiToken;
use App\Models\Business;
use App\Models\Country;
use App\Models\User;
use App\Services\ApiTokenService;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ApiRequestHasTokenMiddlewareTest extends TestCase
{

    use RefreshDatabase;

    private $url = '/test/middleware/apiqequesthastoken';
    private $apiTokenService;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->apiTokenService = new ApiTokenService();
    }

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware('api.token')->any($this->url, function () {
            return response()->json([
                'message' => 'Middleware let the request pass',
            ], 299);
        });
    }

    /**
     * @group api
     * @group middleware
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
        $user = new User();
        $user->name = 'Test user';
        $user->email = 'test@gmail.com';
        $user->password = bcrypt('password');
        $user->role = UserRole::Business;
        $user->direction_direction = 'Calle de la testeada';
        $user->direction_postal_code = '12345';
        $user->direction_poblation = 'Madrid';
        $user->country()->associate(Country::find(1));
        $this->assertTrue($user->save());

        $business = new Business();
        $business->cif = 'A12345678';
        $business->registration_date = now();
        $business->balance = 1000;
        $business->contact_info_email = 'test@gmail.com';
        $business->user()->associate($user);
        $this->assertTrue($business->save());

        $apiToken = new ApiToken();
        $apiToken->issuer = 'Test Issuer';
        $apiToken->expiration_date = now()->addDays(10);
        $apiToken->business()->associate($business);
        $this->assertTrue($apiToken->save());

        return $apiToken;
    }
}
