<?php

require __DIR__ . '/../vendor/autoload.php';

use Application\Source\Http\Factorys\Psr7FactoryCreator;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$routes = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
    http_response_code(404);
    die();
}

//session_start();

$factory = new Psr7FactoryCreator();
$serverRequest = $factory->createServerRequest();

$class = $routes[$_SERVER['REQUEST_URI']];
$container = require __DIR__ . '/../config/dependencies.php';
$controller = $container->get($class);

$response = $controller->handle($serverRequest);

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
