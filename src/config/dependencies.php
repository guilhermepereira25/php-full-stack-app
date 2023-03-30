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

try {
    return $container = $builder->build();
} catch (Exception $e) {
    var_dump($e);
}