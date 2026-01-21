<?php

namespace Jonston\LaravelChat\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Chat message model.
 */
class ChatRoomMessage extends Model
{
    protected $fillable = [
        'text',
        'room_id',
        'member_id',
    ];

    public function getTable(): string
    {
        return config('chat.tables.messages', 'chat_room_messages');
    }

    public function room()
    {
        return $this->belongsTo(
            config('chat.models.room', ChatRoom::class),
            'room_id'
        );
    }

    public function member()
    {
        return $this->belongsTo(
            config('chat.models.member', ChatRoomMember::class),
            'member_id'
        );
    }
}
