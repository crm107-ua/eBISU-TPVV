<?php

namespace App\Services;

use App\Models\ApiToken;
use App\Models\Business;
use Carbon\Carbon;

class ClientTokenService
{
    public function createNewToken($businessId, $issuer = "client token service", $withExpiration = true): ?ApiToken {
        $business = Business::find($businessId);
        if(!$business) return null;

        $this->invalidateBusinessToken($businessId);

        $token = new ApiToken();
        $token->issuer = $issuer;
        $token->expiration_date = $withExpiration ? Carbon::now()->addSeconds(config('app.token_expiration_secconds')) : null;
        $token->invalidated = false;
        $token->times_used = 0;

        return $business->apiTokens()->save($token);
    }

    public function invalidateBusinessToken($businessId): bool {
        $activeToken = ApiToken::where('business_id', $businessId)
            ->where('invalidated', false)
            ->first();
        if(!$activeToken) return false;
        $activeToken->invalidated = true;
        return $activeToken->save();
    }
}
