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
            'host' => 'AAA'
        ];
    }
}