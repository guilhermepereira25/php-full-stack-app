<?php

namespace Application\Source\Http\Controllers;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DefaultController
{
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(200, [], 'Olá :)');
    }
}