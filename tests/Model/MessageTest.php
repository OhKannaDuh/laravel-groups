<?php

namespace OhKannaDuh\Groups\Test\Model;

use OhKannaDuh\Groups\Model\Group;
use OhKannaDuh\Groups\Model\Message;
use OhKannaDuh\Groups\Test\TestCase;
use OhKannaDuh\Groups\Test\User;

class MessageTest extends TestCase
{


    /**
     * Returns a fresh group instance.
     *
     * @return Group
     */
    private function getGroup(): Group
    {
        return Group::create([
            "name" => "group",
            "image" => "image",
            "key" => "a",
        ]);
    }


    /**
     * Ensure our message returns the correct user.
     */
    public function testUser(): void
    {
        $group = $this->getGroup();
        factory(User::class)->create();
        $user = User::firstOrFail();

        $message = Message::create([
            "user_id" => $user->id,
            "group_id" => $group->id,
            "content" => "message",
        ]);

        $this->assertSame($user->id, $message->user->id);
        $this->assertNotNull($message->user->id);
    }


    /**
     * Ensure our message returns the correct group.
     */
    public function testGroup(): void
    {

        $group = $this->getGroup();
        factory(User::class)->create();
        $user = User::firstOrFail();

        $message = Message::create([
            "user_id" => $user->id,
            "group_id" => $group->id,
            "content" => "message",
        ]);

        $this->assertSame($group->id, $message->group->id);
        $this->assertNotNull($message->group->id);
    }
}
