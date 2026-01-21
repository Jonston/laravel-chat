<?php

namespace Jonston\LaravelChat\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Guest model for chat visitors.
 */
class ChatRoomGuest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'meta',
    ];

    public function getTable(): string
    {
        return config('chat.tables.guests', 'chat_room_guests');
    }

    protected $casts = [
        'meta' => 'array',
    ];
}
