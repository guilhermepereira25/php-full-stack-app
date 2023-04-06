<?php

namespace Application\Source\Repository;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMSetup;
use RuntimeException;

class EntityManagerCreator
{
    public function getEntityManager(): EntityManager
    {
        $paths = [__DIR__ . '/../Models'];

        //using docker params in .env
        $dbParams = [
            'host' => $_ENV['DB_HOST'],
            'user' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'dbname' => $_ENV['DB_DATABASE'],
            'charset' => 'UTF8',
            'driver' => 'pdo_mysql'
        ];

        try {
            $config = ORMSetup::createAttributeMetadataConfiguration($paths);
            $connection = DriverManager::getConnection($dbParams, $config);

            return new EntityManager($connection, $config);
        } catch (ORMException $ex) {
            throw new RuntimeException('Fail in connecting with db'. PHP_EOL . $ex->getMessage(), $ex->getCode());
        }
    }
}