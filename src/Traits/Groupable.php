<?php

namespace OhKannaDuh\Groups\Traits;

use Illuminate\Database\Eloquent\Relations\Relation;
use OhKannaDuh\Groups\Model\Group;

trait Groupable
{


    /**
     * @inheritdoc
     */
    public function groups(): Relation
    {
        return $this->belongsToMany(Group::class, "group_user", "user_id", "group_id");
    }


    /**
     * @inheritdoc
     */
    public function canAddToGroup(Group $group): bool
    {
        return true;
    }


    /**
     * @inheritdoc
     */
    public function canRemoveFromGroup(Group $group): bool
    {
        return true;
    }


    /**
     * Determines if thie Groupable can send a message to the group.
     *
     * @return bool
     */
    public function canSendMessageToGroup(Group $group): bool
    {
        return true;
    }
}
