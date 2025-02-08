<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';
    protected $fillable = ['conversation_id', 'sender_phone', 'message', 'is_read'];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
