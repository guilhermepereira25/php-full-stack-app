<?php

namespace Application\Source\Http\Controllers;

use Application\Source\Http\Form\FormProduct;
use Application\Source\Models\Product;
use Application\Source\Repository\ProductRepository;
use Doctrine\DBAL\Exception;
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

    public function __construct(EntityManagerInterface $entityManager, ProductRepository $productRepository)
    {
        $this->repository = $entityManager->getRepository(Product::class);
        $this->productRepository = $productRepository;
    }

    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $data = $this->repository->findAll();

        return new Response(200, ['Content-Type', 'application/json'], Stream::create($data));
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws Exception
     */
    public function create(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() !== 'POST') {
            $code = http_response_code(405);
            $body = Stream::create(json_encode(['success' => false]));
        } else {
            $post = $request->getParsedBody();

            $form = new FormProduct();
            $validate = $form->validate($post);

            if ($validate) {
                $resultSet = $this->productRepository->create(
                    $post['sku'], $post['nome'], $post['price'], $post['type'], $post['value']
                );
                $code = http_response_code(200);
                $body = Stream::create(json_encode($resultSet));
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
        $queryParams = $request->getQueryParams();
        $code = http_response_code(400);

        if (isset($queryParams['id']) && is_int($queryParams['id'])) {
            $this->productRepository->delete($queryParams['id']);
            $code = http_response_code(200);
            $body = Stream::create(json_encode(['success' => true]));
        }

        return new Response($code, ['Content-Type' => 'application/json'], is_null($body) ? Stream::create(json_encode(['success' => false ])) : $body);
    }
}