<?php

namespace OhKannaDuh\Groups\Test\Model;

use App\User;
use OhKannaDuh\Groups\Model\Group;
use OhKannaDuh\Groups\Test\TestCase;
use Illuminate\Support\Facades\DB;

class GroupTest extends TestCase
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
     * Ensures users are correctly added to a group.
     */
    public function testAddUser(): void
    {
        $group = $this->getGroup();

        factory(User::class)->create();
        $user = User::firstOrFail();

        // Make sure our users are empty first
        $this->assertCount(0, $group->users);

        // Add one and check it registers that users is now larger.
        $group->addUser($user);
        $this->assertCount(1, $group->users);
    }


    /**
     * Ensures users are correctly added to the group_user pivot table.
     *
     * @depends testAddUser
     */
    public function testAddUserPivotTable(): void
    {
        $group = $this->getGroup();

        factory(User::class)->create();
        $user = User::firstOrFail();
        $group->addUser($user);

        $users = DB::table("group_user")->get();

        $this->assertCount(1, $users);
    }


    /**
     * Ensures all users are added to a group.
     *
     * @depends testAddUser
     */
    public function testAddUsers(): void
    {
        $group = $this->getGroup();

        factory(User::class, 3)->create();
        $users = User::all();

        $group->addUsers($users);

        $this->assertCount(3, $group->users);
    }


    /**
     * Ensures users are correctly removed from a group.
     *
     * @depends testAddUsers
     */
    public function testRemoveUser(): void
    {
        $group = $this->getGroup();

        factory(User::class, 3)->create();
        $users = User::all();

        $group->addUsers($users);

        $this->assertCount(3, $group->users);

        $user = User::firstOrFail();
        $group->removeUser($user);
        $this->assertCount(2, $group->users);
    }


    /**
     * Ensures users are correctly removed from the group_user pivot table.
     *
     * @depends testRemoveUser
     */
    public function testRemoveUserPivotTable(): void
    {
        $group = $this->getGroup();

        factory(User::class)->create();
        $user = User::firstOrFail();

        $group->addUser($user);
        $users = DB::table("group_user")->get();
        $this->assertCount(1, $users);

        $group->removeUser($user);
        $users = DB::table("group_user")->get();
        $this->assertCount(0, $users);
    }


    /**
     * Ensures all users are removed from a group.
     *
     * @depends testRemoveUser
     */
    public function testRemoveUsers(): void
    {
        $group = $this->getGroup();

        factory(User::class, 5)->create();

        $users = User::all();
        $group->addUsers($users);
        $this->assertCount(5, $group->users);

        $users = User::find(range(1, 3));
        $group->removeUsers($users);
        $this->assertCount(2, $group->users);
    }
}
