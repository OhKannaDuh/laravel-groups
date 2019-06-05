<?php

namespace OhKannaDuh\Groups\Test;

use OhKannaDuh\Groups\GroupsServiceProvider;
use App\User;
use Illuminate\Support\Facades\DB;

class TestCase extends \Orchestra\Testbench\TestCase
{


    /**
     * @inheritdoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(realpath(__DIR__ . "/database/migrations"));
        $this->loadMigrationsFrom(realpath(__DIR__ . "../src/database/migrations"));

        $this->withFactories(__DIR__ . "/database/factories");
    }


    /**
     * @inheritdoc
     */
    protected function getPackageProviders($app)
    {
        return [
            GroupsServiceProvider::class
        ];
    }


    /**
     * @inheritdoc
     */
    protected function getEnvironmentSetUp($app)
    {
        $app["config"]->set("database.default", "testbench");
        $app["config"]->set("database.connections.testbench", [
            "driver"   => "sqlite",
            "database" => ":memory:",
            "prefix"   => "",
        ]);

        $app["config"]->set("groups.user_class", User::class);
    }
}
