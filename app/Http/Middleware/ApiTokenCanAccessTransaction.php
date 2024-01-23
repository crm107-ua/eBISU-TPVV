<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\ApiController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenCanAccessTransaction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = ApiController::getRequestToken($request);
        $transaction = ApiController::getRequestTransaction($request);

        if ($token->business_id != $transaction->business_id) {
            return response()->json([
                'error' => 'Not allowed',
                'description' => 'You can not get transactions from other business',
            ], 403);
        }
        return $next($request);
    }
}
