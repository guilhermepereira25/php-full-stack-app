<?php

namespace Application\Source\Infra;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\ORMSetup;

class EntityManagerCreator
{
    /**
     * @throws MissingMappingDriverImplementation
     */
    public function getEntityManager(): EntityManager
    {
        $paths = [__DIR__ . '/../Entity'];

        //using docker params in .env
        $dbParams = [
            'host' => $_ENV['DB_HOST'],
            'user' => $_ENV['DB_USERNAME'],
            'password' => '',
            'dbname' => $_ENV['DB_DATABASE'],
            'charset' => 'UTF8',
            'driver' => 'pdo_mysql'
        ];

        try {
            $config = ORMSetup::createAttributeMetadataConfiguration($paths);
            $connection = DriverManager::getConnection($dbParams, $config);
        } catch (\Throwable $th) {
            echo json_encode([
                'message' => $th->getMessage(),
                'code' => $th->getCode()
            ]);
        }

        return new EntityManager($connection, $config);
    }
}