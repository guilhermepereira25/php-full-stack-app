<?php

namespace Application\Source\Http\Factorys;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Http\Message\ServerRequestInterface;

class Psr7FactoryCreator
{
    /**
     * @return ServerRequestInterface
     */
    public function createServerRequest(): ServerRequestInterface
    {
        $psr17Factory = new Psr17Factory();

        $creator = new ServerRequestCreator(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );

        return $creator->fromGlobals();
    }
}