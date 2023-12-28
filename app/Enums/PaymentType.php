<?php

namespace App\Enums;

enum PaymentType: string
{
    case CreditCard = 'credit_card';
    case Paypal = 'paypal';
}
