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
     * This method links through to the _addUser method and then reloads the users relationship.
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
     * This method loops over the given collection and calls the _AddUser method with them, then it reloads the users relationship.
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
     * This method attaches the given object to the users collection assuming it matches your configured user class.
     *
     * @param Model $user
     *
     * @return void
     */
    private function _addUser(Model $user): void
    {
        if ($this->isUser($user)) {
            $this->users()->attach($user->id);
        }
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
