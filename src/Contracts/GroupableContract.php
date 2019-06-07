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
}
