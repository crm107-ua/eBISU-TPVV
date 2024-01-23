<?php

namespace Tests\Unit\api;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Tests\TestCase;

/**
 * @group api
 * @group validation
 * @group request_refound_information
 */
class ValidateRequestRefoundInformationRequestTest extends TestCase
{
    private $url = '/test/validation/requestrefoundinformation';

    public function setUp(): void
    {
        parent::setUp();

        Route::middleware(['api.json', 'api.validation.requestrefoundinformation'])->any($this->url, function (Request $request) {
            return response()->json([
                'message' => 'Validation successfull',
            ], 299);
        });
    }

    public function test_valid_refound_information_with_all_values_is_ok()
    {
        $this->postJson($this->url, [
            'concept' => 'concept',
            'receipt_number' => 'AAA',
        ])
            ->assertStatus(299);
    }
}
