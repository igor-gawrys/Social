<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */
  'database' => [
    'default' => env('SOCIAL_DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('SOCIAL_DB_HOST', '127.0.0.1'),
            'port' => env('SOCIAL_DB_PORT', '3306'),
            'database' => env('SOCIAL_DB_DATABASE', 'forge'),
            'username' => env('SOCIAL_DB_USERNAME', 'forge'),
            'password' => env('SOCIAL_DB_PASSWORD', ''),
            'unix_socket' => env('SOCIAL_DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

     ]
    ],
    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    'hash' => [
        /*
        |--------------------------------------------------------------------------
        | Iteration Count
        |--------------------------------------------------------------------------
        |
        | The number of iterations used to hash the password.
        | Minimum: 4, Maximum: 31
        |
        */
        'iteration_count' => 8,
        /*
        |--------------------------------------------------------------------------
        | Portable Hashes
        |--------------------------------------------------------------------------
        |
        | Should we generate portable hashes? true or false
        |
        */
        'portable_hashes' => true,
    ]

];
