<?php

namespace OhKannaDuh\Groups\Test\Traits;

use App\User;
use OhKannaDuh\Groups\Traits\Groupable;

class GroupableUser extends User
{
    use Groupable;

    /** @var string */
    protected $table = "users";
}
