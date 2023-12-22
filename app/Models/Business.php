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
        'discharge_date',
        'balance',
        'contact_info_name',
        'contact_info_phone_number',
        'contact_info_email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
