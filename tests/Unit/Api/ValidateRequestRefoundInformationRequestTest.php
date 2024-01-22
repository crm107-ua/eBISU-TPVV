<?php

namespace Tests\Unit\api;

use App\Services\ApiRequestValidationService;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Tests\TestCase;

class ValidateRequestRefoundInformationRequestTest extends TestCase
{
    private $url = '/test/validation/requestrefoundinformation';

    /**
     * @var ApiRequestValidationService
     */
    private $apiRequestValidationService;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiRequestValidationService = new ApiRequestValidationService();

        Route::any($this->url, function (Request $request) {
            $errors = $this->apiRequestValidationService->validateRequestRefoundInformation($request->json()->all());
            if ($errors->isNotEmpty())
                return response()->json(self::jsonForInvalidPayload($errors), 400);
            return response()->json([
                'message' => 'Validation successfull',
            ], 299);
        });
    }



    private static function joinErrorMessages(MessageBag $errors): string
    {
        return implode(' ', $errors->all());
    }

    private static function jsonForInvalidPayload(MessageBag $errors): array
    {
        return [
            'error' => 'Invalid payload',
            'description' => self::joinErrorMessages($errors),
        ];
    }
}
