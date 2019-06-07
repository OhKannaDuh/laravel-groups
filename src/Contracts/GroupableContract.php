<?php

namespace OhKannaDuh\Groups\Contracts;

use Illuminate\Database\Eloquent\Relations\Relation;

interface GroupableContract
{


    /**
     * Returns all groups.
     *
     * @return Relation
     */
    public function groups(): Relation;
}
