<?php

namespace Tests\Unit\api;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Tests\TestCase;

/**
 * @group api
 * @group validation
 * @group paypal
 */
class ValidatePaymentInformationTest extends TestCase
{
    private $url = '/test/validation/paymentinformation';

    public function setUp(): void
    {
        parent::setUp();

        Route::middleware(['api.json', 'api.validation.paymentinformation'])->any($this->url, function (Request $request) {
            return response()->json([
                'message' => 'Validation successfull',
            ], 299);
        });
    }

    public function test_valid_paypal_request_is_ok()
    {
        $this->postJson($this->url, [
            'type' => 'paypal',
            'values' => [
                'paypal_user' => 'test',
            ]
        ])
            ->assertStatus(299);
    }
}
