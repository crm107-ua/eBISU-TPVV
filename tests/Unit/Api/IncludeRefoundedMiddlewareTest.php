<?php

namespace Tests\Unit\Api;

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * @group api
 * @group middleware
 * @group include_refound
 */
class IncludeRefoundedMiddlewareTest extends TestCase
{

    private $url = '/test/middleware/includerefounded';

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware('api.transaction.refounded')->any($this->url, function () {
            return response()->json([
                'message' => 'Middleware let the request pass',
            ], 299);
        });
    }

    public function test_invalid_includeRefound_fails(): void
    {
        $this->getJson($this->url . '?includeRefound=')
            ->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->getJson($this->url . '?includeRefound=1')
            ->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->getJson($this->url . '?includeRefound=0')
            ->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->getJson($this->url . '?includeRefound=TRUE')
            ->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->getJson($this->url . '?includeRefound=FALSE')
            ->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->getJson($this->url . '?includeRefound=aaa')
            ->assertStatus(Response::HTTP_BAD_REQUEST);
    }

}
