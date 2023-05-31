<?php

namespace Application\Source\Models;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'product')]
class DVD extends Product
{
    protected string $type = 'dvd';

    public function getType(): string
    {
        return $this->type;
    }
}