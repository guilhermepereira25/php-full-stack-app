<?php

namespace Application\Source\Models;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'product')]
class Furniture extends Product
{
    protected string $type = 'furniture';

    public function getType(): string
    {
        return $this->type;
    }
}