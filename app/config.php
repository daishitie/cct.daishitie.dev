<?php

return [

    /*
    |--------------------------------------------------------------------------
    | App Configuration
    |--------------------------------------------------------------------------
    */

    'app' => [
        'name' => env('app_name'),
        'debug' => env('app_debug'),
        'url' => env('app_url'),
        'environment' => env('app_environment'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Database Configuration
    |--------------------------------------------------------------------------
    */

    'db' => [
        'host' => env('db_host'),
        'port' => env('db_port'),
        'database' => env('db_database'),
        'username' => env('db_username'),
        'password' => env('db_password'),
        'charset' => env('db_charset'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Database Configuration
    |--------------------------------------------------------------------------
    */

    'regex' => [
        'username' => '/^[a-zA-Z0-9]*$/',
        'password' => '/^(.{0,7}|[^a-z]*|[^\d]*)$/i',
    ],

    /*
    |--------------------------------------------------------------------------
    | Allowed Email Provider
    |--------------------------------------------------------------------------
    */

    'provider' => [

        'allowed' => [
            'docomo.co.jp',
            'yahoo.co.jp',
            'gmail.com',
            'yahoo.com',
            'ymail.com',
            'rocketmail.com',
            'outlook.com',
            'hotmail.com',
            'aol.com',
            'aim.com',
        ],

    ],

];
