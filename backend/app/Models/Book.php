<?php

namespace Application\Source\Models;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'product')]
class Book extends Product
{
    protected string $type = 'book';

    public function getType(): string
    {
        return $this->type;
    }
}