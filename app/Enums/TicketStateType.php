<?php

namespace App\Enums;

enum TicketStateType: string
{
    case Open = 'open';
    case Resolving = 'resolving';
    case Closed = 'closed';
}
