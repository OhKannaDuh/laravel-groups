<?php

namespace OhKannaDuh\Groups\Traits;

use Illuminate\Database\Eloquent\Relations\Relation;
use OhKannaDuh\Groups\Model\Group;

trait Groupable
{


    /**
     * Returns all groups this model belongs to.
     *
     * @return Relation
     */
    public function groups(): Relation
    {
        return $this->belongsToMany(Group::class, "group_user", "user_id", "group_id");
    }
}
