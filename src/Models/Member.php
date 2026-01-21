<?php

namespace Jonston\LaravelChat\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Member wrapper model that morphs to actual member types (user/guest/bot).
 */
class Member extends Model
{
    protected $table = 'chat_room_members';

    protected $fillable = [
        'member_id',
        'member_type',
    ];

    public function member()
    {
        return $this->morphTo();
    }
}
