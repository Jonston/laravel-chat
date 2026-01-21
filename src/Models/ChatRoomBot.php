<?php

namespace Jonston\LaravelChat\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Bot model for automated participants.
 */
class ChatRoomBot extends Model
{
    protected $fillable = [
        'name',
        'provider',
        'meta',
    ];

    public function getTable(): string
    {
        return config('chat.tables.bots', 'chat_room_bots');
    }

    protected $casts = [
        'meta' => 'array',
    ];
}
