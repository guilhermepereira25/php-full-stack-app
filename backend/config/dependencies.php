<?php

use Application\Source\Repository\EntityManagerCreator;
use Application\Source\Repository\ProductRepository;
use DI\ContainerBuilder;
use Doctrine\ORM\EntityManagerInterface;

$builder = new ContainerBuilder();
$builder->addDefinitions([
    EntityManagerInterface::class => function() {
        return (new EntityManagerCreator)->getEntityManager();
    },
    ProductRepository::class => function($container) {
        return (new ProductRepository($container->get(EntityManagerInterface::class)));
    }
]);

try {
    return $builder->build();
} catch (Exception $e) {
    throw new \RuntimeException('Fail build container' . PHP_EOL . $e->getMessage(), $e->getCode());
}