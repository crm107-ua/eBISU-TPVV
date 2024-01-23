<?php

namespace Tests\Unit\api;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Tests\TestCase;

/**
 * @group api
 * @group validation
 * @group request_transaction_creation
 */
class ValidateRequestTransactionCreationRequestTest extends TestCase
{
    private $url = '/test/validation/requesttransactioncreation';


    public function setUp(): void
    {
        parent::setUp();

        Route::middleware(['api.json', 'api.validation.requesttransactioncreation'])->any($this->url, function (Request $request) {
            return response()->json([
                'message' => 'Validation successfull',
            ], 299);
        });
    }

    public function test_valid_transaction_creation_with_just_amount_is_ok()
    {
        $this->postJson($this->url, [
            'amount' => 150,
        ])
            ->assertStatus(299);
    }
}
