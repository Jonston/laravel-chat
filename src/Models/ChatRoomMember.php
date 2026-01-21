<?php

namespace Jonston\LaravelChat\Models;

use Illuminate\Database\Eloquent\Model;
use Jonston\LaravelChat\Traits\HasChatRooms;

/**
 * Member wrapper model that morphs to actual member types (user/guest/bot).
 */
class ChatRoomMember extends Model
{
    use HasChatRooms;

    protected $fillable = [
        'member_id',
        'member_type',
    ];

    public function getTable(): string
    {
        return config('chat.tables.members', 'chat_room_members');
    }

    public function member()
    {
        return $this->morphTo();
    }

    /**
     * Create a ChatRoomMember wrapper for any Eloquent model instance.
     */
    public static function createForModel($model): self
    {
        return static::create([
            'member_id' => $model->getKey(),
            'member_type' => get_class($model),
        ]);
    }
}
