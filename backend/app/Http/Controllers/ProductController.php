<?php

namespace Application\Source\Http\Controllers;

use Application\Source\Http\Form\FormProduct;
use Application\Source\Models\Product;
use Application\Source\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Nyholm\Psr7\Response;
use Nyholm\Psr7\Stream;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductController
{
    private EntityRepository $repository;
    private ProductRepository $productRepository;

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
        if ($request->getMethod() !== 'POST') {
            $code = http_response_code(405);
            $body = Stream::create(json_encode(['success' => false]));
        } else {
            $post = $request->getParsedBody();

            $form = new FormProduct();
            $validate = $form->validate($post);

            if ($validate == 0) {
                //$this->productRepository->create($post['sku'], $post['nome'], $post['price'], $post['type'], $post['value']);
                $code = http_response_code(200);
                $body = Stream::create(json_encode($post));
            } else {
                $code = http_response_code(403);
                $body = Stream::create(json_encode(['success' => false, 'message' => 'invalid parameters']));
            }
        }

        return new Response($code, ['Content-Type' => 'application/json'], $body);
    }

    public function update(ServerRequestInterface $request): ResponseInterface
    {
        $request = json_encode($request->getQueryParams());

        return new Response(200, [], Stream::create($request));
    }

    public function delete(ServerRequestInterface $request): ResponseInterface
    {
    }
}