<?php

use Doctrine\ORM\EntityManagerInterface;
use Application\Source\Infra\EntityManagerCreator;
use DI\ContainerBuilder;

$builder = new ContainerBuilder();
$builder->addDefinitions([
    EntityManagerInterface::class => function() {
        return (new EntityManagerCreator)->getEntityManager();
    }
]);
$container = $builder->build();

return $container;