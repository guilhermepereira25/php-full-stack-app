<?php

namespace Application\Source\Models;

use Application\Source\Abstract\BaseProduct;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;

#[Entity]
#[Table(name: 'product')]
class Product extends BaseProduct implements \JsonSerializable
{
    #[Id, Column, GeneratedValue]
    protected int $id;
    #[Column]
    protected string $sku;
    #[Column]
    protected string $name;
    #[Column(type: Types::DECIMAL)]
    protected float $price;
    #[Column]
    protected string $type;
    #[Column(type: Types::FLOAT)]
    protected float $value;

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

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->getId(),
            'sku' => $this->getSku(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'type' => $this->getType(),
            'value' => $this->getValue()
        ];
    }
}