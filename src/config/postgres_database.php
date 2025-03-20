<?php

return [
    'driver' => 'pgsql',
    'host' => 'postgres',
    'port' => '5432',
    'database' => getenv('POSTGRES_DB'),
    'username' => getenv('POSTGRES_USER'),
    'password' => getenv('POSTGRES_PASSWORD'),
];