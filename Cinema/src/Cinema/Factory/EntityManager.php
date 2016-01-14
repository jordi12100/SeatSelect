<?php

namespace Cinema\Factory;

use Doctrine\ORM\Tools\Setup;

class EntityManager
{
    /**
     * @TODO we all know that this isn't the right place for a db config
     * @var array
     */
    protected static $databaseConfig = [
        'driver'   => 'pdo_mysql',
        'user'     => 'root',
        'password' => '',
        'dbname'   => 'foo',
    ];

    public static function factory()
    {
        $paths = [__dir__ . '/../Model/'];
        $isDevMode = false;

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
        return \Doctrine\ORM\EntityManager::create(self::$databaseConfig, $config);
    }
}
