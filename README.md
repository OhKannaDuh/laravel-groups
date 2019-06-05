# Laravel Groups

This package allows you to group your user models, you can use this for various things.

## Installation

First, install the package via composer.

```sh
composer require ohkannaduh/laravel-groups
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
...
class User extends Model
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

#### Get all users in a group
```php
$group->users
```

#### Get all groups for a user
```php
$user->groups
```
