<?php

namespace App\Enums;

enum FinalizeReason: int
{
    case OK = 0;
    case INSUFFICIENT_BALANCE = 1;
    case TIMEOUT = 2;
    case INVALID_PAYMENT_INFORMATION = 3;
    case CANCELLED = 4;
}
