<?php

use Dotenv\Dotenv;

Dotenv::createImmutable(__DIR__ . '/../')->load();

function env($key)
{
    return $_ENV[strtoupper($key)];
}

function config($key)
{
    $config = require __DIR__ . '/config.php';
    $config = &$config;
    $exists = true;

    foreach (explode('.', $key) as $step) {
        if (isset($config[$step])) {
            $config = &$config[$step];
        } else {
            $exists = false;
        }
    }

    if ($exists) {
        return $config;
    }

    return 'Key (' . $key . ') not found.';
}
