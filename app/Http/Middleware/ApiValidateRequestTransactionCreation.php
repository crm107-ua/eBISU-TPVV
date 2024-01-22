<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\ApiController;
use App\Services\ApiRequestValidationService;
use Closure;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiValidateRequestTransactionCreation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $errors = ApiRequestValidationService::validateRequestTransactionCreation(ApiController::getRequestBody($request));
        if ($errors->isNotEmpty())
            return response()->json(self::jsonForInvalidPayload($errors), 400);
        return $next($request);
    }

    public static function joinErrorMessages(MessageBag $errors): string
    {
        return implode(' ', $errors->all());
    }

    public static function jsonForInvalidPayload(MessageBag $errors): array
    {
        return [
            'error' => 'Invalid transaction creation payload',
            'description' => self::joinErrorMessages($errors),
        ];
    }
}
