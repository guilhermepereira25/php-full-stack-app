<?php

namespace Application\Source\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\ParameterType;
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
    public function create($sku, $name, $price, $type, $value): bool|array
    {
        $sql = "INSERT INTO product (sku, name, price, type, value, created_at) 
                VALUES (:sku, :name, :price, :type, :value, NOW());";
        $stmt = $this->coon->prepare($sql);
        $stmt->bindValue(':sku', $sku);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':price', $price, 'decimal');
        $stmt->bindValue(':type', $type);
        $stmt->bindValue(':value', $value, 'float');

        try {
            $result = $stmt->executeQuery();
            return $result->fetchAssociative();
        } catch (ORMException $exception) {
            throw new RuntimeException('Error creating product in db ' . '-' . $exception->getMessage(), $exception->getCode());
        }
    }

    public function delete($id)
    {

    }
}