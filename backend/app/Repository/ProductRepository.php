<?php

namespace Application\Source\Repository;

use Application\Source\Models\Book;
use Application\Source\Models\DVD;
use Application\Source\Models\Furniture;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use RuntimeException;

class ProductRepository
{
    private Connection $coon;
    private EntityManager $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->coon = $entityManager->getConnection();
    }

    /**
     * @throws Exception
     */
    public function create($sku, $name, $price, $type, $value)
    {
        switch ($type) {
            case 'book':
                $productObject = new Book();
                break;

            case 'DVD':
                $productObject = new DVD();
                break;

            case 'furniture':
                $productObject = new Furniture();
                break;

            default:
                return;
        }

        $productObject->setSku($sku);
        $productObject->setName($name);
        $productObject->setPrice($price);
        $productObject->setType($productObject->getType());
        $productObject->setValue($value);
        $productObject->created_at = date('Y-m-d H:i:s');

        try {
            $this->entityManager->persist($productObject);
            $this->entityManager->flush();
        } catch (Exception $exception) {
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