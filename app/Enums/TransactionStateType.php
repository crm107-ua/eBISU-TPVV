<?php

namespace App\Enums;

enum TransactionStateType: string
{
    case Waiting = 'waiting';
    case Accepted = 'accepted';
    case Cancelled = 'cancelled';
}
