<?php

namespace App\Models;

use App\Enums\PaymentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'paypal_user',
        'credit_card_number',
        'credit_card_month_of_expiration',
        'credit_card_year_of_expiration',
        'credit_card_csv',
    ];

    protected $casts = [
        'type' => PaymentType::class,
    ];

    public function transaction() {
        return $this->hasOne(Transaction::class, 'payment_id');
    }
}
