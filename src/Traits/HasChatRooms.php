<?php

namespace Jonston\LaravelChat\Traits;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Trait to provide `rooms()` relation for chat member wrapper models.
 */
trait HasChatRooms
{
    /**
     * Get the rooms this member has participated in (via messages).
     */
    public function rooms(): HasManyThrough
    {
        $roomClass = config('chat.models.room');
        $messageClass = config('chat.models.message');

        return $this->hasManyThrough(
            $roomClass,
            $messageClass,
            'member_id', // Foreign key on messages table...
            'id',        // Local key on rooms table (default primary key)
            'id',        // Local key on this model (members.id)
            'room_id'    // Foreign key on messages that references rooms
        );
    }
}
