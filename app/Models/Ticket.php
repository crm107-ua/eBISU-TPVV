<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'creation_date',
        'state',
        'priority',
        'attachment_id',
        'technitian_id',
        'valoration_comment',
        'valoration_valoration',
        'transaction_id',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'ticket_id');
    }

    public function attachment()
    {
        return $this->belongsTo(Attachment::class, 'attachment_id');
    }

    public function technitian()
    {
        return $this->belongsTo(Technician::class, 'technitian_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
