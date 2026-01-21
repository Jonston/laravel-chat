<?php

namespace Jonston\LaravelChat\Services;

use Jonston\LaravelChat\Models\ChatRoom;
use Jonston\LaravelChat\Models\СhatRoomMessage;
use Jonston\LaravelChat\Models\ChatRoomMember;

/**
 * High-level chat service for creating rooms and sending messages.
 */
class ChatService
{
    public function createRoom(string $name)
    {
        $roomClass = config('chat.models.room', ChatRoom::class);

        return ($roomClass)::create(['name' => $name]);
    }

    public function sendMessage($member, $room, string $text)
    {
        $messageClass = config('chat.models.message', ChatRoomMessage::class);

        return ($messageClass)::create([
            'text' => $text,
            'room_id' => $room->id,
            'member_id' => $member->id,
        ]);
    }

    /**
     * Delete a room by model or id.
     */
    public function deleteRoom($room): bool
    {
        $roomClass = config('chat.models.room', ChatRoom::class);

        if (! $room instanceof $roomClass) {
            $room = ($roomClass)::findOrFail($room);
        }

        return (bool) $room->delete();
    }

    /**
     * Return members (ChatRoomMember instances) for a room.
     */
    public function getMembers($room)
    {
        $roomClass = config('chat.models.room', ChatRoom::class);

        if (! $room instanceof $roomClass) {
            $room = ($roomClass)::findOrFail($room);
        }

        return $room->members()->get();
    }

    /**
     * Add a member wrapper for a given model (user/guest/bot).
     * Returns the ChatRoomMember instance.
     */
    public function addMember($model)
    {
        $memberClass = config('chat.models.member', ChatRoomMember::class);
        // prefer createForModel if available
        if (method_exists($memberClass, 'createForModel')) {
            return ($memberClass)::createForModel($model);
        }

        return ($memberClass)::create([
            'member_id' => $model->getKey(),
            'member_type' => get_class($model),
        ]);
    }

    /**
     * Remove a member wrapper by instance or id.
     */
    public function removeMember($member): bool
    {
        $memberClass = config('chat.models.member', ChatRoomMember::class);

        if (! $member instanceof $memberClass) {
            $member = ($memberClass)::findOrFail($member);
        }

        return (bool) $member->delete();
    }

    /**
     * Get messages for a room.
     */
    public function getMessages($room, int $perPage = null)
    {
        $roomClass = config('chat.models.room', ChatRoom::class);
        $messageClass = config('chat.models.message', ChatRoomMessage::class);

        if (! $room instanceof $roomClass) {
            $room = ($roomClass)::findOrFail($room);
        }

        $query = ($messageClass)::where('room_id', $room->id)->latest();
        return $perPage ? $query->paginate($perPage) : $query->get();
    }

    /**
     * Create a message.
     */
    public function createMessage($member, $room, string $text)
    {
        return $this->sendMessage($member, $room, $text);
    }

    /**
     * Update a message text.
     */
    public function updateMessage($message, string $text)
    {
        $messageClass = config('chat.models.message', ChatRoomMessage::class);
        
        if (! $message instanceof $messageClass) {
            $message = ($messageClass)::findOrFail($message);
        }

        $message->text = $text;
        $message->save();

        return $message;
    }

    /**
     * Delete a message.
     */
    public function deleteMessage($message): bool
    {
        $messageClass = config('chat.models.message', ChatRoomMessage::class);
        
        if (! $message instanceof $messageClass) {
            $message = ($messageClass)::findOrFail($message);
        }

        return (bool) $message->delete();
    }
}
