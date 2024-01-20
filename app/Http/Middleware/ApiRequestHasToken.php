<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Carbon\Carbon;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use UnexpectedValueException;

class ApiRequestHasToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'error' => 'No token',
                'description' => 'You did not provide a token',
            ], 401);
        }

        $secret = env('JWT_SECRET');
        $algorithm = env('JWT_ALGO');

        try {
            $token = JWT::decode($token, new Key($secret, $algorithm));
        } catch (UnexpectedValueException $e) {
            return response()->json([
                'error' => 'No token',
                'description' => 'The provided token is invalid',
            ], 401);
        }

        $tokenId = $token->id;

        $token = ApiToken::find($tokenId);

        if (!$token) {
            return response()->json([
                'error' => 'No token',
                'description' => 'The provided token does not exist',
            ], 401);
        }

        if ($token->invalidated) {
            return response()->json([
                'error' => 'No token',
                'description' => 'The provided token is invalidated',
            ], 401);
        }

        if (Carbon::parse($token->expiration_date)->isPast()) {
            return response()->json([
                'error' => 'No token',
                'description' => 'The provided token expired on ' . $token->expiration_date,
            ], 401);
        }

        $token->times_used = $token->times_used + 1;
        $token->save();

        $request->attributes->add(['api_token' => $token]);

        return $next($request);
    }
}
