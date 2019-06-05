<?php

namespace OhKannaDuh\Groups\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use OhKannaDuh\Groups\Model\Group;

trait Groupable
{


    /**
     * Returns all groups this model belongs to.
     *
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, "group_user", "user_id", "group_id");
    }
}
