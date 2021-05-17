<?php

// user (string): Username to use when connecting to the database.
// password (string): Password to use when connecting to the database.
// host (string): Hostname of the database to connect to.
// port (integer): Port of the database to connect to.
// dbname (string): Name of the database/schema to connect to.
// unix_socket (string): Name of the socket used to connect to the database.
// charset (string): The charset used when connecting to the database.

// include the composer autoloader for autoloading packages
require_once(__DIR__ . '/vendor/autoload.php');

require_once(__DIR__ . '/entities/RPSGame.php');
require_once(__DIR__ . '/entities/RPSRound.php');
// // set up an autoloader for loading classes that aren't in /vendor
// // $classDirs is an array of all folders to load from
// $classDirs = array(
//     __DIR__,
//     __DIR__ . './entities',
// );

// new \iRAP\Autoloader\Autoloader($classDirs);

function getEntityManager(): \Doctrine\ORM\EntityManager
{
    $entityManager = null;

    if ($entityManager === null) {
        $paths = array(__DIR__ . '/entities');
        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths);

        # set up configuration parameters for doctrine.
        # Make sure you have installed the php7.0-sqlite package.
        $connectionParams = array(
            'driver' => 'pdo_sqlite',
            'path'   => __DIR__ . '/data/my-database.db',
        );
        $dbParams = array(
            'driver'         => 'pdo_mysql',
            'user'           => 'root',
            'password'       => '',
            'host'           => 'localhost',
            'port'           => 3306,
            'dbname'         => 'usarps_orm',
            'charset'        => 'UTF8',
        );


        $entityManager = \Doctrine\ORM\EntityManager::create($dbParams, $config);
    }

    return $entityManager;
}
