<?php

require __DIR__ . '/../vendor/autoload.php';

use Application\Source\Http\Factorys\Psr7FactoryCreator;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$routes = require __DIR__ . '/../config/api.php';

$urlParsed = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (!array_key_exists($urlParsed, $routes)) {
    http_response_code(404);
    die();
}

$factory = new Psr7FactoryCreator();
$serverRequest = $factory->createServerRequest();

$class = $routes[$urlParsed]['controller'];
$container = require __DIR__ . '/../config/dependencies.php';
$controller = $container->get($class);

$method = $routes[$urlParsed]['method'];
$response = $controller->$method($serverRequest);

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
