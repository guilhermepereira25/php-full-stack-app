<?php

namespace Application\Source\Http\Controllers;

use Application\Source\Models\Product;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Nyholm\Psr7\Stream;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductController
{
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Product::class);
    }

    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $data = [
            'response' => 'ok',
            'request' => $request->getHeaders()
        ];
    
        $json = json_encode($data);
    
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type',
            'Content-Type' => 'application/json',
        ];
    
        return new Response(200, $headers, Stream::create($json));
    }
}