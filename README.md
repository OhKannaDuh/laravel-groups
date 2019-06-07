# Laravel Groups

This package allows you to group your user models, you can use this for various things.

## Installation

First, install the package via composer.

```sh
composer require ohkannaduh/groups
```

If you are using Laravel version 5.5 or lower you'll need to register `OhKannaDuh\Groups\GroupsServiceProvider` in your `config/app.php` providers array.

```php
    'providers' => [
    ...
        /*
        * Package Service Providers...
        */
        OhKannaDuh\Groups\GroupsServiceProvider::class
    ...
    ],
```

To publish config files and migrations run:
```sh
php artisan vendor:publish --provider="OhKannaDuh\Groups\GroupsServiceProvider"
```

Configure the package by modifying `config/groups.php`

Then finally run the migrations:
```sh
php artisan migrate
```

## Configure your User model
```php
...
use OhKannaDuh\Groups\Traits\Groupable;
use OhKannaDuh\Groups\Contracts\GroupableContract;
...
class User extends Model implements GroupableContract
{
    use Groupable;
    ...
}
```

## Usage

#### Add a user to a group
```php
$group->addUser($user);
```

#### Add a colleciton of users to a group
```php
$group->addUsers($users);
```

#### Remove a user from a group
```php
$group->removeUser($user);
```

#### Remove a colleciton of users from a group
```php
$group->removeUsers($users);
```

#### Check if a user is in a group
```php
$group->contains($user)
```

#### Get all users in a group
```php
$group->users
```

#### Get all groups for a user
```php
$user->groups
```

#### Can add to group logic

You can add this method to your user class to add custom logic for adding users to groups:
```php
public function canAddToGroup(\OhKannaDuh\Groups\Model\Group $group): bool
```

Here is an example:
```php
public function canAddToGroup(\OhKannaDuh\Groups\Model\Group $group): bool
{
    foreach ($group->users as $user) {
        /**
         * This user has been blocked or has blocked the other user.
         * Don't add them to the group.
         */
        if ($user->isBlocked($this) === true) {
            return false;
        }
    }

    return true;
}
```
This method just returns `true` by default.
