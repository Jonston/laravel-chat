<?php

namespace Jonston\LaravelChat\Services;

use Jonston\LaravelChat\Models\Room;
use Jonston\LaravelChat\Models\Member;
use Jonston\LaravelChat\Models\Message;

/**
 * High-level chat service for creating rooms and sending messages.
 */
class ChatService
{
    public function createRoom(string $name): Room
    {
        return Room::create(['name' => $name]);
    }

    public function sendMessage(Member $member, Room $room, string $text): Message
    {
        return Message::create([
            'text' => $text,
            'room_id' => $room->id,
            'member_id' => $member->id,
        ]);
    }
}
