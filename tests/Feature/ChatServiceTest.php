<?php

namespace Jonston\LaravelChat\Tests\Feature;

use Jonston\LaravelChat\Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Jonston\LaravelChat\Models\ChatRoom;
use Jonston\LaravelChat\Models\ChatRoomMember;
use Jonston\LaravelChat\Models\ChatRoomMessage;

class ChatServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        
        Artisan::call('migrate');
    }

    public function test_create_room()
    {
        $service = new \Jonston\LaravelChat\Services\ChatService();

        $room = $service->createRoom('Room A');
        $this->assertInstanceOf(ChatRoom::class, $room);
        $this->assertDatabaseHas(config('chat.tables.rooms'), ['name' => 'Room A']);
    }

    public function test_add_member()
    {
        $service = new \Jonston\LaravelChat\Services\ChatService();

        $guestClass = config('chat.models.guest');
        $guest = ($guestClass)::create(['name' => 'Visitor']);

        $member = $service->addMember($guest);
        $this->assertInstanceOf(ChatRoomMember::class, $member);
        $this->assertDatabaseHas(config('chat.tables.members'), ['member_id' => $guest->getKey()]);
    }

    public function test_create_and_retrieve_messages()
    {
        $service = new \Jonston\LaravelChat\Services\ChatService();

        $room = $service->createRoom('Room Messages');
        $guestClass = config('chat.models.guest');
        $guest = ($guestClass)::create(['name' => 'Visitor']);
        $member = $service->addMember($guest);

        $m1 = $service->createMessage($member, $room, 'Hello 1');
        $m2 = $service->createMessage($member, $room, 'Hello 2');

        $this->assertInstanceOf(ChatRoomMessage::class, $m1);
        $this->assertInstanceOf(ChatRoomMessage::class, $m2);

        $messages = $service->getMessages($room);
        $this->assertCount(2, $messages);
    }

    public function test_create_message()
    {
        $service = new \Jonston\LaravelChat\Services\ChatService();

        $room = $service->createRoom('Room Msg Create');
        $guestClass = config('chat.models.guest');
        $guest = ($guestClass)::create(['name' => 'Visitor']);
        $member = $service->addMember($guest);

        $m = $service->createMessage($member, $room, 'Solo');
        $this->assertInstanceOf(ChatRoomMessage::class, $m);
        $this->assertDatabaseHas(config('chat.tables.messages'), ['text' => 'Solo']);
    }

    public function test_get_messages()
    {
        $service = new \Jonston\LaravelChat\Services\ChatService();

        $room = $service->createRoom('Room Msg Get');
        $guestClass = config('chat.models.guest');
        $guest = ($guestClass)::create(['name' => 'Visitor']);
        $member = $service->addMember($guest);

        $service->createMessage($member, $room, 'One');
        $service->createMessage($member, $room, 'Two');

        $messages = $service->getMessages($room);
        $this->assertCount(2, $messages);
    }

    public function test_update_message()
    {
        $service = new \Jonston\LaravelChat\Services\ChatService();

        $room = $service->createRoom('Room Update');
        $guestClass = config('chat.models.guest');
        $guest = ($guestClass)::create(['name' => 'Visitor']);
        $member = $service->addMember($guest);

        $m = $service->createMessage($member, $room, 'Before');
        $updated = $service->updateMessage($m, 'After');
        $this->assertEquals('After', $updated->text);
    }

    public function test_delete_message()
    {
        $service = new \Jonston\LaravelChat\Services\ChatService();

        $room = $service->createRoom('Room Delete');
        $guestClass = config('chat.models.guest');
        $guest = ($guestClass)::create(['name' => 'Visitor']);
        $member = $service->addMember($guest);

        $m = $service->createMessage($member, $room, 'To be removed');
        $this->assertTrue($service->deleteMessage($m));
        $this->assertDatabaseMissing(config('chat.tables.messages'), ['text' => 'To be removed']);
    }

    public function test_pagination_on_messages()
    {
        $service = new \Jonston\LaravelChat\Services\ChatService();

        $room = $service->createRoom('Room Paginate');
        $guestClass = config('chat.models.guest');
        $guest = ($guestClass)::create(['name' => 'Visitor']);
        $member = $service->addMember($guest);

        for ($i = 0; $i < 3; $i++) {
            $service->createMessage($member, $room, "msg{$i}");
        }

        $paginated = $service->getMessages($room, 2);
        $this->assertEquals(2, $paginated->perPage());
        $this->assertEquals(3, $paginated->total());
    }

    public function test_remove_member_and_delete_room()
    {
        $service = new \Jonston\LaravelChat\Services\ChatService();

        $room = $service->createRoom('Room Final');
        $guestClass = config('chat.models.guest');
        $guest = ($guestClass)::create(['name' => 'Visitor']);
        $member = $service->addMember($guest);

        // create a message so member appears in room members via messages relation
        $service->createMessage($member, $room, 'ping');
        $this->assertCount(1, $service->getMembers($room));
    }

    public function test_remove_member()
    {
        $service = new \Jonston\LaravelChat\Services\ChatService();

        $guestClass = config('chat.models.guest');
        $guest = ($guestClass)::create(['name' => 'Visitor']);
        $member = $service->addMember($guest);

        $this->assertTrue($service->removeMember($member));
        $this->assertDatabaseMissing(config('chat.tables.members'), ['member_id' => $guest->getKey()]);
    }

    public function test_delete_room()
    {
        $service = new \Jonston\LaravelChat\Services\ChatService();

        $room = $service->createRoom('Room To Delete');
        $this->assertTrue($service->deleteRoom($room));
        $this->assertDatabaseMissing(config('chat.tables.rooms'), ['name' => 'Room To Delete']);
    }
}
