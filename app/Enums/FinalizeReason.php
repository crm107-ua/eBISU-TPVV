<?php

namespace App\Enums;

enum FinalizeReason: int
{
    case OK = 0;
    case INSUFFICIENT_BALANCE = 1;
    case TIMEOUT = 2;
    case INVALID_PAYMENT_INFORMATION = 3;
    case CANCELLED = 4;

    public function getApiMessage(): string {
        return match($this) {
            self::OK => 'OK',
            self::INSUFFICIENT_BALANCE => 'INSUFFICIENT_BALANCE',
            self::TIMEOUT => 'TIMEOUT',
            self::INVALID_PAYMENT_INFORMATION => 'INVALID_PAYMENT_INFORMATION',
            self::CANCELLED => 'CANCELLED',
        };
    }
}
