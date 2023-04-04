<?php

namespace Application\Source\Abstract;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\MappedSuperclass;

#[MappedSuperclass]
abstract class BaseProduct
{
    protected int $id;
    protected string $sku;
    protected string $name;
    protected float $price;
    protected string $type;
    protected string $value;

    abstract protected function createNewProduct();
    abstract protected function getAllProducts();
    abstract protected function updateProduct();
    abstract protected function deleteProduct();
}