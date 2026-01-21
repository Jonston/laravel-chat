<?php

namespace Jonston\LaravelChat\Services;

use Jonston\LaravelChat\Models\Message;

/**
 * Message-related helper methods.
 */
class MessageService
{
    public function paginateRoomMessages(int $roomId, int $perPage = 50)
    {
        return Message::where('room_id', $roomId)->latest()->paginate($perPage);
    }
}
