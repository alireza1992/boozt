<?php

use App\Core\Application;
use App\Controllers\{ChartController,
    CustomerController,
    OrderController
};

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application(dirname(__DIR__));
$app->router->get('/chart', [ChartController::class, 'index']);
$app->router->get('/customers', [CustomerController::class, 'index']);
$app->router->get('/orders', [OrderController::class, 'index']);

$app->run();