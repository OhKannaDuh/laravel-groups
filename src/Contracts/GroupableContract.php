<?php

namespace OhKannaDuh\Groups\Contracts;

use Illuminate\Database\Eloquent\Relations\Relation;
use OhKannaDuh\Groups\Model\Group;

interface GroupableContract
{


    /**
     * Returns all groups.
     *
     * @return Relation
     */
    public function groups(): Relation;


    /**
     * Determines if this Groupable can be added to the given group.
     *
     * @return bool
     */
    public function canAddToGroup(Group $group): bool;


    /**
     * Determines if this Groupable can be removed from the given group.
     *
     * @return bool
     */
    public function canRemoveFromGroup(Group $group): bool;


    /**
     * Determines if thie Groupable can send a message to the group.
     *
     * @return bool
     */
    public function canSendMessageToGroup(Group $group): bool;
}
