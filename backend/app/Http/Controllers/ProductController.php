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
    private int $code;

    public function __construct(EntityManagerInterface $entityManager, ProductRepository $productRepository)
    {
        $this->repository = $entityManager->getRepository(Product::class);
        $this->productRepository = $productRepository;
    }

    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $data = $this->repository->findAll();

        return new Response(200, ['Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*'], Stream::create(json_encode($data)));
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws Exception
     */
    public function create(ServerRequestInterface $request): ResponseInterface
    {
        header('Accept: application/json');
        $body = null;

        if ($request->getMethod() !== 'POST') {
            $this->setCode(405);
            $body = Stream::create(json_encode(['success' => false]));
        } else {
            $post = json_decode(file_get_contents('php://input'), true);

            $form = new FormProduct();
            $validate = $form->validate($post);

            if ($validate) {
                $sku = $this->repository->findOneBy(['sku' => $post['sku']]);

                if (is_null($sku)) {
                    $resultSet = $this->productRepository->create(
                        $post['sku'], $post['name'], $post['price'], $post['type'], $post['value']
                    );
                    $this->setCode(201);
                    $body = Stream::create(json_encode(['result' => $resultSet, 'success' => true]));
                }
            } else {
                $this->setCode(403);
                $body = Stream::create(json_encode(['success' => false, 'message' => 'invalid parameters']));
            }
        }

        return new Response($this->getCode(), ['Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*'], $body);
    }

    public function delete(ServerRequestInterface $request)
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $this->setCode(400);
        $body = null;

        if (isset($post['ids'])) {
            $this->productRepository->delete($post['ids']);
            $this->setCode(200);
            $body = Stream::create(json_encode(['success' => true]));
        } else {
            $this->setCode(403);
            $body = Stream::create(json_encode(['message' => 'Invalid params']));
        }

        return new Response($this->getCode(), ['Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*'], $body);
    }

    private function setCode($code)
    {
        $this->code = http_response_code($code);
    }

    private function getCode()
    {
        return $this->code;
    }
}