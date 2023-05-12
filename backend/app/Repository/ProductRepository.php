<?php

namespace Application\Source\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
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

    public function delete($ids)
    {
        try {
            foreach ($ids as $id) {
                $this->coon->delete('product', ['id' => $id]);
            }
        } catch (Exception $exception) {
            throw new RuntimeException('Error deleting product in db' . '-', $exception->getMessage(), $exception->getCode());
        }
    }
}