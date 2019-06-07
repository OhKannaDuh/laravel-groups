<?php

namespace OhKannaDuh\Groups\Test\Traits;

use OhKannaDuh\Groups\Test\User;
use OhKannaDuh\Groups\Model\Group;
use OhKannaDuh\Groups\Test\TestCase;
use OhKannaDuh\Groups\Contracts\MessageableContract;

class MessageableTest extends TestCase
{

    /**
     * @inheritdoc
     */
    public function setUp(): void
    {
        parent::setUp();

        factory(User::class, 1)->create();
    }


    /**
     * Returns a fresh Mesageable object..
     *
     * @return MessageableContract
     */
    private function getMessageable(): MessageableContract
    {
        return Group::create([
            "name" => "group",
            "image" => "image",
            "key" => "a",
        ]);
    }


    /**
     * Ensures messages can be sent.
     */
    public function testSendMessage(): void
    {
        $messageable = $this->getMessageable();
        $user = User::firstOrFail();
        $messageable->addUser($user);
        $sent = $messageable->sendMessage($user, "message");
        $this->assertTrue($sent);
    }


    /**
     * Ensures all messages can be gotten.
     */
    public function testMessages(): void
    {
        $messageable = $this->getMessageable();
        $user = User::firstOrFail();
        $messageable->addUser($user);

        $this->assertCount(0, $messageable->messages);
        $messageable->sendMessage($user, "message");
        $messageable->sendMessage($user, "message");
        $messageable->sendMessage($user, "message");
        $messageable->sendMessage($user, "message");
        $messageable->load("messages");
        $this->assertCount(4, $messageable->messages);
    }


    /**
     * Ensure only groupables of the messageable can sent a message.
     */
    public function testCanSendMessage(): void
    {
        $messageable = $this->getMessageable();
        factory(User::class)->create();

        $user1 = User::findOrFail(1);
        $user2 = User::findOrFail(2);

        $messageable->addUser($user1);

        $this->assertTrue($messageable->sendMessage($user1, "message"));
        $this->assertFalse($messageable->sendMessage($user2, "message"));

    }
}
