<?php

namespace OhKannaDuh\Groups\Model;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    /** @var array */
    protected $fillable = [
        "name", "image", "key"
    ];


    /**
     * Adds a user to a group using the _addUser method and then reloads the users property.
     *
     * @param Model $user
     *
     * @return void
     */
    public function addUser(Model $user): void
    {
        $this->_addUser($user);

        $this->load("users");
    }


    /**
     * Adds a collection of users to a group using the _addUser method and then reloads the users property.
     *
     * @param Collection $users
     *
     * @return void
     */
    public function addUsers(Collection $users): void
    {
        foreach ($users as $user) {
            $this->_addUser($user);
        }

        $this->load("users");
    }


    /**
     * Removes a user from a group using the _removeUser method and then reloads the users property.
     *
     * @param Model $user
     *
     * @return void
     */
    public function removeUser(Model $user): void
    {
        $this->_removeUser($user);

        $this->load("users");
    }


    /**
     * Removes a collection of user from a group using the _removeUser method and then reloads the users property.
     *
     * @param Collection $users
     *
     * @return void
     */
    public function removeUsers(Collection $users): void
    {
        foreach ($users as $user) {
            $this->_removeUser($user);
        }

        $this->load("users");
    }


    /**
     * Removes the given user from the group.
     *
     * @param Model $user
     *
     * @return void
     */
    private function _addUser(Model $user): void
    {
        if ($this->isUser($user) === true && $this->contains($user) === false) {
            $this->users()->attach($user->id);
        }
    }


    /**
     * Removes the given user from the group.
     *
     * @param Model $user
     *
     * @return void
     */
    private function _removeUser(Model $user): void
    {
        if ($this->isUser($user) === true && $this->contains($user) === true) {
            $this->users()->detach($user->id);
        }
    }


    /**
     * Checks if the given user is in this group.
     *
     * @param Model $user
     *
     * @return bool
     */
    public function contains(Model $user): bool
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
     * Checks if a given model is a user.
     *
     * @param Model $model
     *
     * @return bool
     */
    private function isUser(Model $model): bool
    {
        return is_a($model, config("groups.user_class"));
    }
}
