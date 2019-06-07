<?php

namespace OhKannaDuh\Groups\Model;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OhKannaDuh\Groups\Contracts\GroupableContract;
use OhKannaDuh\Groups\Contracts\MessageableContract;
use OhKannaDuh\Groups\Traits\Messageable;

class Group extends Model implements \Countable, MessageableContract
{
    use Messageable;

    /** @var array */
    protected $fillable = [
        "name", "image", "key"
    ];


    /**
     * Adds a user to a group using the addUserToGroup method and then reloads the users property.
     *
     * @param GroupableContract $user
     *
     * @return void
     */
    public function addUser(GroupableContract $user): void
    {
        $this->addUserToGroup($user);

        $this->load("users");
    }


    /**
     * Adds a collection of users to a group using the addUserToGroup method and then reloads the users property.
     *
     * @param Collection $users
     *
     * @return void
     */
    public function addUsers(Collection $users): void
    {
        foreach ($users as $user) {
            $this->addUserToGroup($user);
        }

        $this->load("users");
    }


    /**
     * Removes a user from a group using the removeUserFromGroup method and then reloads the users property.
     *
     * @param GroupableContract $user
     *
     * @return void
     */
    public function removeUser(GroupableContract $user): void
    {
        $this->removeUserFromGroup($user);

        $this->load("users");
    }


    /**
     * Removes a collection of user from a group using the removeUserFromGroup method and then reloads the users property.
     *
     * @param Collection $users
     *
     * @return void
     */
    public function removeUsers(Collection $users): void
    {
        foreach ($users as $user) {
            $this->removeUserFromGroup($user);
        }

        $this->load("users");
    }


    /**
     * Checks if the given user can be added to this group based on capacity and the user.
     *
     * @param GroupableContract $user
     *
     * @return bool
     */
    public function canAddToGroup(GroupableContract $user): bool
    {
        return (
            $user->canAddToGroup($this) === true &&
            $this->isAtCapacity() === false &&
            $this->contains($user) === false
        );
    }


    /**
     * Checks if the given user can be removed from this group.
     *
     * @param GroupableContract $user
     *
     * @return bool
     */
    public function canRemoveFromGroup(GroupableContract $user): bool
    {
        return (
            $user->canRemoveFromGroup($this) === true
            && $this->contains($user) === true
        );
    }


    /**
     * Removes the given user from the group.
     *
     * @param GroupableContract $user
     *
     * @return void
     */
    private function addUserToGroup(GroupableContract $user): void
    {
        if ($this->canAddToGroup($user)) {
            $this->users()->attach($user->id);
        }
    }


    /**
     * Removes the given user from the group.
     *
     * @param GroupableContract $user
     *
     * @return void
     */
    private function removeUserFromGroup(GroupableContract $user): void
    {
        if ($this->canRemoveFromGroup($user) === true) {
            $this->users()->detach($user->id);
        }
    }


    /**
     * Checks if the given user is in this group.
     *
     * @param GroupableContract $user
     *
     * @return bool
     */
    public function contains(GroupableContract $user): bool
    {
        return $this->users->contains($user);
    }


    /**
     * Gets a collection of users in this group.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(config("groups.user_class"), "group_user");
    }


    /**
     * Determines wether this group is at capacity.
     *
     * @return bool
     */
    private function isAtCapacity(): bool
    {
        $count = count($this);
        $max = config("groups.max_users");

        if ($max <= 0 || $max == false) {
            return false;
        }

        return $count >= $max;
    }


    /**
     * Returns the number of users in this group.
     *
     * @return int
     */
    public function count(): int
    {
        $this->load("users");
        return count($this->users);
    }
}
