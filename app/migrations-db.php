<?php

include  __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/helpers.php';

Dotenv::load(__DIR__);

return [
    'dbname' => env('DB_DATABASE'),
    'user' => env('DB_USERNAME'),
    'password' => env('DB_PASSWORD'),
    'host' => env('DB_HOSTNAME'),
    'driver' => 'pdo_mysql',
];
