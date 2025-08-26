<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'message', 'is_read'];

    public function sender()
    {
        return $this->belongsTo(Team::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Team::class, 'receiver_id');
    }
}
