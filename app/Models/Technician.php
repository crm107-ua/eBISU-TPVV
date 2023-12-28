<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'technitian_id');
    }
}
