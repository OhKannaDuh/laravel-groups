<?php

namespace OhKannaDuh\Groups\Test;

use OhKannaDuh\Groups\Contracts\GroupableContract;
use OhKannaDuh\Groups\Traits\Groupable;

class User extends \App\User implements GroupableContract
{
    use Groupable;
}
