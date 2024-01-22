<?php

namespace App\Enums;

enum TransactionStateType: string
{
    case Waiting = 'waiting';
    case Accepted = 'accepted';
    case Cancelled = 'cancelled';

    function getApiName(): string {
        return match($this) {
            self::Waiting => 'waiting',
            self::Accepted => 'accepted',
            self::Cancelled => 'rejected',
        };
    }
}
