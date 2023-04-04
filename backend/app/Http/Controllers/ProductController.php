<?php

namespace Application\Source\Http\Controllers;

use Nyholm\Psr7\Response;
use Nyholm\Psr7\Stream;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ProductController implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [
            'response' => 'ok',
            'request' => $request->getParsedBody()
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