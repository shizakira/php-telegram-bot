<?php

/**
 * @return string[]
 */
return [
    'driver' => 'pgsql',
    'host' => 'postgres',
    'port' => '5432',
    'database' => 'postgres',
    'username' => getenv('POSTGRES_USER'),
    'password' => getenv('POSTGRES_PASSWORD'),
];