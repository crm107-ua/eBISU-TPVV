<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'upload_date',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'attachment_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'attachment_id');
    }
}
