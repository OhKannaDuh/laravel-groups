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
}
