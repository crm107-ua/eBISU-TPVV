<?php

namespace App\Models;

use App\Enums\FinalizeReason;
use App\Enums\TransactionStateType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'concept',
        'amount',
        'state',
        'receipt_number',
        'emision_date',
        'finished_date',
        'finalize_reason',
        'refounds_id',
        'business_id',
        'payment_id',
    ];

    protected $casts = [
        'emision_date' => 'datetime',
        'finished_date' => 'datetime',
        'state' => TransactionStateType::class,
        'finalize_reason' => FinalizeReason::class,
        'amount' => 'double'
    ];

    public function payment() {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function business() {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function refoundedBy() {
        return $this->belongsTo(Transaction::class, 'refounds_id');
    }

    public function refoundsTo() {
        return $this->hasOne(Transaction::class, 'refounds_id');
    }

    public function tickets() {
        return $this->hasMany(Ticket::class, 'transaction_id');
    }
}
