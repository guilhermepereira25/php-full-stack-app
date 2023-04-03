<?php

namespace Application\Source\Models;

use Application\Source\Abstract\BaseProduct;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity
 * @Table(name="product")
 */
class Product extends BaseProduct
{
    private int $id;
    private string $sku;
    private string $name;
    private float $price;
    private string $type;
    private string $value;

    public function getId(): int
    {
        return $this->id;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getType(): string
    {
        return $this->type;
    }

   public function getValue(): float
   {
       return $this->value;
   }

   public function setId($id): void
   {
       $this->id = $id;
   }

   public function setSku($sku)
   {
       $this->sku = $sku;
   }

   public function setName($name)
   {
       $this->name = $name;
   }

   public function setPrice($price)
   {
       $this->price = $price;
   }

   public function setType($type)
   {
       $this->type = $type;
   }

   public function setValue($value)
   {
       $this->value = $value;
   }

    protected function createNewProduct()
    {
        // TODO: Implement createNewProduct() method.
    }

    protected function getAllProducts()
    {
        // TODO: Implement getAllProducts() method.
    }

    protected function updateProduct()
    {
        // TODO: Implement updateProduct() method.
    }

    protected function deleteProduct()
    {
        // TODO: Implement deleteProduct() method.
    }
}