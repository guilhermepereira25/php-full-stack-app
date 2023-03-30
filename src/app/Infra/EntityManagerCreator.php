<?php

namespace Application\Source\Infra;

class EntityManagerCreator
{
    public function getEntityManager()
    {
        $paths = [__DIR__ . '/../Entity'];
        $isDevMode = false;

        //using docker params
        $dbParams = [
            'host' => $_ENV['DB_HOST'],
            'user' => $_ENV['DB_USERNAME'],
            'password' => '',
            'dbname' => 'product',
            'charset' => 'UTF8',
            'driver' => 'pdo_mysql'
        ];
    }
}