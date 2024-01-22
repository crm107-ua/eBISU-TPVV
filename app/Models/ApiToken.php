<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'issuer',
        'expiration_date',
        'times_used',
        'invalidated',
        'business_id',
    ];

    protected $casts = [
        'invalidated' => 'boolean',
        'expiration_date' => 'datetime',
        'times_used' => 'integer'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

}
