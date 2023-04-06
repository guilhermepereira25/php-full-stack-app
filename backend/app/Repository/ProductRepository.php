<?php

namespace Application\Source\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use RuntimeException;

class ProductRepository
{
    private Connection $coon;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->coon = $entityManager->getConnection();
    }

    /**
     * @throws Exception
     */
    public function create($sku, $name, $price, $type, $value): void
    {
        $sql = "INSERT INTO product (SKU, nome, price, type, value) 
                VALUES (':sku', ':name', ':price', ':type', ':value');";
        $stmt = $this->coon->prepare($sql);
        $stmt->bindValue(':sku', $sku);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':type', $type);
        $stmt->bindValue(':value', $value);

        try {
            $stmt->executeQuery();
        } catch (ORMException $exception) {
            throw new RuntimeException('Error creating product in db ' . '-' . $exception->getMessage(), $exception->getCode());
        }
    }
}