<?php

use Application\Source\Http\Controllers\DefaultController;
use Application\Source\Http\Controllers\ProductController;

return [
    //routes here
    '/api' => ['controller' => DefaultController::class, 'method' => 'index'],
    '/api/products' => ['controller' => ProductController::class, 'method' => 'index'],
    '/api/products/create' => ['controller' => ProductController::class, 'method' => 'create'],
    '/api/products/update' => ['controller' => ProductController::class, 'method' => 'update'],
    '/api/products/delete' => ['controller' => ProductController::class, 'method' => 'delete'],
];