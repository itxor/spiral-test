<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

use Spiral\Database\Driver;

return [
    'default'   => 'default',
    'databases' => [
        'default' => ['driver' => 'default'],
    ],
    'drivers'   => [
        'default' => [
            'driver'     => Driver\Postgres\PostgresDriver::class,
            'connection' => sprintf('pgsql:host=%s;dbname=%s', env('DB_HOST'), env('DB_NAME')),
            'username'   => env('DB_USER'),
            'password'   => env('DB_PASSWORD'),
        ],
    ]
];
