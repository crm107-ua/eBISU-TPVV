<?php

namespace App\Enums;

enum TicketStateType: string
{
    case Open = 'open';
    case Resolving = 'resolving';
    case Closed = 'closed';

    public static function getValues(): array
    {
        return [
            self::Open->value,
            self::Resolving->value,
            self::Closed->value,
        ];
    }
}
