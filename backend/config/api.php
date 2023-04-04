<?php

use Application\Source\Http\Controllers\ProductController;

return [
    //routes here
    '/products' => ['controller' => ProductController::class, 'method' => 'index'],

];