<?php

use Jonston\LaravelChat\Models\ChatRoom;
use Jonston\LaravelChat\Models\ChatRoomMessage;
use Jonston\LaravelChat\Models\ChatRoomMember;
use Jonston\LaravelChat\Models\ChatRoomGuest;
use Jonston\LaravelChat\Models\ChatRoomBot;

return [

    /*
    |--------------------------------------------------------------------------
    | Chat Tables
    |--------------------------------------------------------------------------
    |
    | Table names used by the chat package. If you do not want to use
    | guests or bots, set the corresponding entry to false (e.g.:
    | 'guests' => false). The migrations will respect these values.
    |
    */
    'tables' => [
        'rooms' => 'chat_rooms',
        'messages' => 'chat_room_messages',
        'members' => 'chat_room_members',
        'guests' => 'chat_room_guests',
        'bots' => 'chat_room_bots',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | Pagination settings for messages and conversations.
    |
    */
    'pagination' => [
        'messages_per_page' => 50,
        'conversations_per_page' => 20,
    ],

    /*
    |--------------------------------------------------------------------------
    | Model Classes
    |--------------------------------------------------------------------------
    |
    | Default model classes used by the package. You can override these
    | in your application config to use custom models. Use ::class where
    | possible so static analysis and refactors work better.
    |
    */
    'models' => [
        'room' => ChatRoom::class,
        'message' => ChatRoomMessage::class,
        'member' => ChatRoomMember::class,
        'guest' => ChatRoomGuest::class,
        'bot' => ChatRoomBot::class,
        'user' => env('CHAT_USER_MODEL', 'App\\Models\\User'),
    ],

];
