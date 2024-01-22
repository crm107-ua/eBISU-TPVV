<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;

/**
 * @group api
 * @group middleware
 * @group json_body
 */
class ApiJsonRequestMiddlewareTest extends TestCase
{
    private $url = '/test/middleware/apijsonrequest';

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware('api.json')->any($this->url, function () {
            return response()->json([
                'message' => 'Middleware let the request pass',
            ], 299);
        });
    }

    public function test_valid_request_passes_the_middleware()
    {
        $this->postJson($this->url, [
            'valid' => 'json',
        ])
            ->assertStatus(299)
            ->assertJson([
                'message' => 'Middleware let the request pass',
            ]);
    }

    public function test_empty_request_fails_the_middleware()
    {
        $this->postJson($this->url, [])
            ->assertStatus(400)
            ->assertJson([
                'error' => 'Invalid payload',
                'description' => 'The payload is empty',
            ]);
    }

}
