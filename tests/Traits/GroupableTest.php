<?php

namespace OhKannaDuh\Groups\Test\Traits;

use OhKannaDuh\Groups\Test\User;
use OhKannaDuh\Groups\Model\Group;
use OhKannaDuh\Groups\Test\TestCase;

class GroupableTest extends TestCase
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
     * Returns a groupable user.
     *
     * @return User
     */
    private function getGroupable(): User
    {
        return User::firstOrFail();
    }


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
     * Ensures that the groups relationship succesfully returns all groups.
     */
    public function testGroups(): void
    {
        $user = $this->getGroupable();

        $this->getGroup()->addUser($user);
        $user->load("groups");
        $this->assertCount(1, $user->groups);

        $this->getGroup()->addUser($user);
        $user->load("groups");
        $this->assertCount(2, $user->groups);
    }
}
