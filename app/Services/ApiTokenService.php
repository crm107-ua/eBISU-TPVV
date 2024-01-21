<?php

namespace App\Services;

use App\Enums\FinalizeReason;
use App\Enums\TransactionStateType;
use App\Models\ApiToken;
use App\Models\Business;
use App\Models\Transaction;
use Carbon\Carbon;
use Firebase\JWT\JWT;

class ApiTokenService
{

    public function jsonify(Transaction $transaction, $includeRefound = false): ?array
    {
        if (!$transaction) return null;

        $json = [
            'id' => $transaction->id,
            'amount' => (int) $transaction->amount,
            'state' => $transaction->state->getApiName(),
            'emision_date' => $this->formatDate($transaction->emision_date),
        ];

        if ($transaction->concept)
            $json['concept'] = $transaction->concept;

        if ($transaction->receipt_number)
            $json['concept'] = $transaction->receipt_number;

        if ($transaction->state != TransactionStateType::Waiting) {
            $json['finalized_date'] = $this->formatDate($transaction->finished_date);
            $json['finalized_reason'] = $transaction->finalize_reason->getApiMessage();
        }

        if ($transaction->refounds_id) {
            if ($includeRefound) {
                $refounded = Transaction::find($transaction->refounds_id);
                $json['refounds'] = $this->jsonify($refounded);
            } else {
                $json['refounds'] = $transaction->refounds_id;
            }
        }

        return $json;
    }

    public function encode(ApiToken $token): string
    {
        $secret = env('JWT_SECRET');
        $algorithm = env('JWT_ALGO');

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

    private function formatDate($date)
    {
        return Carbon::parse($date)->toIso8601String();
    }
}
