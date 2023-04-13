<?php

namespace Application\Test;

use Buzz\Client\Curl;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;

class ProductTest extends TestCase
{
    //nginx is host inside docker
    private $baseUrl = 'http://nginx:80/api/products/create';

    /**
     * @throws ClientExceptionInterface
     */
    public function test_creation_process()
    {
        $serverRequest = new Psr17Factory();
        $psr18Client = new Curl($serverRequest);

        $data = [
            'sku' => 'SKU20490294042',
            'name' => 'Teste',
            'price' => (float) 10.2,
            'type' => 'book',
            'value' => (float) 2.5
        ];

        $body = http_build_query($data);
        $request = $serverRequest->createRequest("POST", $this->baseUrl)
            ->withHeader('Content-Type', 'application/x-www-form-urlencoded')
            ->withBody($serverRequest->createStream($body));
        $response = $psr18Client->sendRequest($request);
        $this->assertEquals(200, $response->getStatusCode(), 'Status code is not 200');

        $post = json_decode($response->getBody()->getContents(), true);

        $this->assertIsArray($post, 'Post is not an array');

        // Assert that the response data matches the expected data
        $this->assertArrayHasKey('sku', $post);
        $this->assertArrayHasKey('name', $post);
        $this->assertArrayHasKey('price', $post);
        $this->assertArrayHasKey('type', $post);
        $this->assertArrayHasKey('value', $post);
        $this->assertEquals('SKU20490294042', $post['sku']);
        $this->assertEquals('Teste', $post['name']);
        $this->assertEquals(10.2, $post['price']);
        $this->assertEquals('book', $post['type']);
        $this->assertEquals(2.5, $post['value']);
    }

    public function test_invalid_fields()
    {
        $serverRequest = new Psr17Factory();
        $psr18Client = new Curl($serverRequest);

        $data = [
            'sku' => 'SKU20490294042',
            'name' => 'Teste',
            'price' => (float) 10.2,
            'type' => 'anyway',
            'value' => (float) 2.5
        ];

        $body = http_build_query($data);
        $request = $serverRequest->createRequest("POST", $this->baseUrl)
            ->withHeader('Content-Type', 'application/x-www-form-urlencoded')
            ->withBody($serverRequest->createStream($body));
        $response = $psr18Client->sendRequest($request);
        $this->assertEquals(403, $response->getStatusCode(), 'Status code is not 403');
    }

    public function test_delete_products()
    {

    }
}