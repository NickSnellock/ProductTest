<?php

use App\Controllers\ProductController;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new DI\Container();

/** @var ProductController $productListController */
$productListController = $container->get(ProductController::class);

if (count($_GET) > 0 && isset($_GET['productId'])) {
    echo $productListController->getProductDetail($_GET['productId']);
} else {
    echo $productListController->getProductList();
}
