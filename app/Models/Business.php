<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'cif',
        'registration_date',
        'balance',
        'contact_info_name',
        'contact_info_phone_number',
        'contact_info_email',
    ];

    protected $casts = [
        'registration_date' => 'datetime',
        'discharge_date' => 'datetime',
        'balance' => 'double',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function apiTokens()
    {
        return $this->hasMany(ApiToken::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'business_id');
    }
}
