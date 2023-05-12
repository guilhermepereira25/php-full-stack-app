<?php

namespace Application\Source\Repository;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMSetup;
use RuntimeException;
use function DI\env;
use function DI\get;

class EntityManagerCreator
{
    public function getEntityManager(): EntityManager
    {
        $paths = [__DIR__ . '/../Models'];

        if ($url = env('CLEARDB_DATABASE_URL', false)) {
            $parts = parse_url($url);
            $host = $parts["host"];
            $port = getenv('DB_PORT');
            $user = $parts["user"];
            $password = $parts["pass"];
            $dbname = substr($parts["path"], 1);
        } else {
            $host = $_ENV['DB_PORT'];
            $port = $_ENV['DB_PORT'];
            $user = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];
            $dbname = $_ENV['DB_DATABASE'];
        }

        //using docker params in .env
        $dbParams = [
            'host' => $host,
            'port' => $port,
            'user' => $user,
            'password' => $password,
            'dbname' => $dbname,
            'charset' => 'UTF8',
            'driver' => 'pdo_mysql'
        ];

        try {
            $config = ORMSetup::createAttributeMetadataConfiguration($paths, false);
            $connection = DriverManager::getConnection($dbParams, $config);

            return new EntityManager($connection, $config);
        } catch (ORMException $ex) {
            throw new RuntimeException('Fail in connecting with db'. PHP_EOL . $ex->getMessage(), $ex->getCode());
        }
    }
}