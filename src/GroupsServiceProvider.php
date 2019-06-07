<?php

namespace OhKannaDuh\Groups;

use Illuminate\Support\ServiceProvider;

class GroupsServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");

        $this->publishes([
            __DIR__ . "/config/groups.php" => config_path("groups.php"),
        ]);
    }
}
