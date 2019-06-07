<?php

return [

    "target_php_version" => "7.2",

    // Add third party
    "directory_list" => [
        "src",
        "vendor/laravel/laravel",
        "vendor/laravel/framework",
        ".phan/stubs",
    ],
    "exclude_analysis_directory_list" => [
        "src/Traits",
        "vendor",
        ".phan/stubs",
    ],

    "plugins" => [
        "AlwaysReturnPlugin",
        "DollarDollarPlugin",
        "DuplicateArrayKeyPlugin",
        "PregRegexCheckerPlugin",
        "PrintfCheckerPlugin",
        "UnreachableCodePlugin",
        "NoAssertPlugin",
        "NonBoolBranchPlugin"
    ],

    // Due to how laravel models work
    "allow_missing_properties" => true,
];
