<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message'
    ];

    public function userMessage()
    {
        return $this->hasMany(UserMessage::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_messages', 'message_id', 'sender_id')
            ->withTimestamps();
    }
}
