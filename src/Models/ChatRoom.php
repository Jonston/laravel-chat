<?php


namespace Jonston\LaravelChat\Models;

use Illuminate\Database\Eloquent\Model;
use Jonston\LaravelChat\Traits\HasChatMembers;

/**
 * Chat room model.
 */
class ChatRoom extends Model
{
    use HasChatMembers;

    protected $fillable = [
        'name',
    ];

    public function getTable(): string
    {
        return config('chat.tables.rooms', 'chat_rooms');
    }

    public function messages()
    {
        return $this->hasMany(ChatRoomMessage::class, 'room_id');
    }
}
