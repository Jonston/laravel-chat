<?php

namespace Jonston\LaravelChat\Traits;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Trait to provide `members()` relation for chat room models.
 */
trait HasChatMembers
{
    /**
     * Get members that have participated in this room (via messages).
     */
    public function members(): HasManyThrough
    {
        $memberClass = config('chat.models.member');
        $messageClass = config('chat.models.message');

        return $this->hasManyThrough(
            $memberClass,
            $messageClass,
            'room_id',   // foreign key on messages table pointing to rooms
            'id',        // local key on members table (primary key)
            'id',        // local key on this model (rooms.id)
            'member_id'  // foreign key on messages that references members
        );
    }
}
