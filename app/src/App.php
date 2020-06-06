<?php

/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

declare(strict_types=1);

namespace App;

use App\Bootloader;
use Spiral\Bootloader as Framework;
use Spiral\DotEnv\Bootloader as DotEnv;
use Spiral\Framework\Kernel;
use Spiral\Monolog\Bootloader as Monolog;
use Spiral\Nyholm\Bootloader as Nyholm;
use Spiral\Prototype\Bootloader as Prototype;
use Spiral\Scaffolder\Bootloader as Scaffolder;
use Spiral\Stempler\Bootloader as Stempler;
use Spiral\Router\Bootloader as Router;
use Spiral\Bootloader\Security\FiltersBootloader;

class App extends Kernel
{
    protected const LOAD = [
        // Base extensions
        DotEnv\DotenvBootloader::class,
        Monolog\MonologBootloader::class,

        // Application specific logs
        Bootloader\LoggingBootloader::class,

        // Core Services
        Framework\SnapshotsBootloader::class,

        // Security and validation
        Framework\Security\EncrypterBootloader::class,
        Framework\Security\ValidationBootloader::class,
        Framework\Security\FiltersBootloader::class,
        Framework\Security\GuardBootloader::class,

        // HTTP extensions
        Nyholm\NyholmBootloader::class,
        Framework\Http\RouterBootloader::class,
        Framework\Http\ErrorHandlerBootloader::class,
        Framework\Http\JsonPayloadsBootloader::class,

        // Databases
        Framework\Database\DatabaseBootloader::class,
        Framework\Database\MigrationsBootloader::class,

        // ORM
        Framework\Cycle\CycleBootloader::class,
        Framework\Cycle\ProxiesBootloader::class,
        Framework\Cycle\AnnotatedBootloader::class,

        // Additional dispatchers
        Framework\Jobs\JobsBootloader::class,

        // Extensions and bridges
        Stempler\StemplerBootloader::class,

        // Framework commands
        Framework\CommandBootloader::class,
        Scaffolder\ScaffolderBootloader::class,

        // Debug and debug extensions
        Framework\DebugBootloader::class,
        Framework\Debug\LogCollectorBootloader::class,
        Framework\Debug\HttpCollectorBootloader::class,

        Router\AnnotatedRoutesBootloader::class,

        FiltersBootloader::class
    ];

    /*
     * Application specific services and extensions.
     */
    protected const APP = [
        Prototype\PrototypeBootloader::class,
    ];
}
