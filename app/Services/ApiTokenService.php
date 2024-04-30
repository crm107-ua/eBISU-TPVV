<?php

namespace App\Services;

use App\Models\ApiToken;
use App\Models\Business;
use Carbon\Carbon;
use Firebase\JWT\JWT;

class ApiTokenService
{
    public function encode(ApiToken $token): string
    {
        $secret = 'vFufZkVXAsPnEDg1O81XE8G8EXAg6dbuyeBsKv1lxCIdszCM1U8whMoMfyqokLmg';
        $algorithm = 'HS256';

        return JWT::encode([
            'id' => $token->id,
        ], $secret, $algorithm);
    }

    public function createNewToken($businessId, $issuer = 'client token service', $withExpiration = true): ?ApiToken
    {
        $business = Business::find($businessId);
        if (!$business) return null;

        $this->invalidateBusinessToken($businessId);

        $token = new ApiToken();
        $token->issuer = $issuer;
        $token->expiration_date = $withExpiration ? Carbon::now()->addSeconds(env('TOKEN_EXPIRATION_SECCONDS')) : null;
        $token->invalidated = false;
        $token->times_used = 0;

        return $business->apiTokens()->save($token);
    }

    public function invalidateBusinessToken($businessId): bool
    {
        $activeToken = $this->getActiveToken($businessId);
        if (!$activeToken) return false;
        $activeToken->invalidated = true;
        return $activeToken->save();
    }

    public function getActiveToken($businessId): ?ApiToken
    {
        return ApiToken::where('business_id', $businessId)
            ->where('invalidated', false)
            ->where('expiration_date', '>', now())
            ->first();
    }

    public function getLatestToken($businessId): ?ApiToken
    {
        return ApiToken::where('business_id', $businessId)
            ->orderBy('expiration_date', 'desc')
            ->first();
    }
}