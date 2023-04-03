<?php

namespace Application\Source\Abstract;

abstract class BaseProduct
{
    abstract protected function createNewProduct();
    abstract protected function getAllProducts();
    abstract protected function updateProduct();
    abstract protected function deleteProduct();
}