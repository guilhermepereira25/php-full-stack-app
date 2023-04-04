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
            'data' => 'content'
        ];

        $json = json_encode($data);

        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET',
            'Access-Control-Allow-Headers' => 'Content-Type',
            'Content-Type' => 'application/json',
        ];

        return new Response(200, $headers, Stream::create($json));
    }

    public function create(ServerRequestInterface $request): ResponseInterface
    {

    }

    public function update(ServerRequestInterface $request): ResponseInterface
    {
        $headers = $request->getHeaders();

        $request = json_encode($request->getQueryParams());

        return new Response(200, [], Stream::create($request));
    }

    public function delete(ServerRequestInterface $request): ResponseInterface
    {

    }
}