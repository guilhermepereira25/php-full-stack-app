<?php

require __DIR__ . '/../vendor/autoload.php';

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

phpinfo();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$test = $_ENV['DB_HOST'];

var_dump($test, $dotenv);

//$routes = require __DIR__ . '/../config/routes.php';
//
//if (!array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
//    http_response_code(404);
//    die();
//}

//session_start();

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory,
    $psr17Factory,
    $psr17Factory,
    $psr17Factory
);

$serverRequest = $creator->fromGlobals();

$class = $_SERVER['REQUEST_URI'];
$container = require __DIR__ . '/../config/dependencies.php';
$controller = $container->get($class);

$response = $controller->handle();

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
