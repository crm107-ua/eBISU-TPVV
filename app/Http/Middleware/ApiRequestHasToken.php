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

        $secret = 'vFufZkVXAsPnEDg1O81XE8G8EXAg6dbuyeBsKv1lxCIdszCM1U8whMoMfyqokLmg';
        $algorithm = 'HS256';

        try {
            $token = JWT::decode($token, new Key($secret, $algorithm));
            if(!$token) {
                return response()->json([
                    'error' => 'Invalid token',
                    'description' => 'The provided token is invalid',
                ], 401);
            }
        } catch (UnexpectedValueException $e) {
            return response()->json([
                'error' => 'Invalid token',
                'description' => 'The provided token is invalid',
            ], 401);
        }

        $tokenId = $token->id;
        if(!$tokenId) {
            return response()->json([
                'error' => 'Invalid token',
                'description' => 'The provided token is invalid',
            ], 401);
        }

        $token = ApiToken::find($tokenId);

        if (!$token) {
            return response()->json([
                'error' => 'Invalid token',
                'description' => 'The provided token does not exist',
            ], 401);
        }

        if ($token->invalidated) {
            return response()->json([
                'error' => 'Invalid token',
                'description' => 'The provided token is invalidated',
            ], 401);
        }

        $expiration = Carbon::parse($token->expiration_date);
        if ($expiration->isPast()) {
            return response()->json([
                'error' => 'Invalid token',
                'description' => 'The provided token expired on ' . $expiration->toIso8601String(),
            ], 401);
        }

        $timesUsed = $token->times_used;
        $token->times_used = $timesUsed != null ? $timesUsed + 1 : 1;
        $token->save();

        $request->attributes->add(['api_token' => $token]);

        return $next($request);
    }
}