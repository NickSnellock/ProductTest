<?php

namespace Tests\Controllers;

use App\Comms\Comms;
use App\Controllers\ProductController;
use Mockery;
use PHPUnit\Framework\TestCase;

class ProductControllerTest extends TestCase
{
    public function testGetProductList()
    {
        $comms = Mockery::mock(Comms::class);
        $comms->shouldReceive('getList')->andReturn(['productId' => 'product 1']);

        $productController = new ProductController($comms);
        $result = $productController->getProductList();

        $this->assertEquals("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Product List</title>
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\"
          integrity=\"sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T\" crossorigin=\"anonymous\">
</head>
<body>
<div class=\"container\">
    <div class=\"card <div class=\" card border-primary
    \">
    <div class=\"card-body\">
        <h4 class=\"card-title\">Product List</h4><ul class=\"list-group list-group-flush\">
            <li class=\"list-group-item\"><a href=\"./index.php?productId=productId\">product 1</a></li>
    </ul>
</div>
</div>
<script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\"
        integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\"
        crossorigin=\"anonymous\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\"
        integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\"
        crossorigin=\"anonymous\"></script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\"
        integrity=\"sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM\"
        crossorigin=\"anonymous\"></script>
</body>\n", $result);
    }

    public function testGetProductDetail()
    {
        $comms = Mockery::mock(Comms::class);
        $comms->shouldReceive('getProductDetail')->andReturn(
            [
                'productId' => [
                    'name' => 'product 1',
                    'description' => 'product description',
                    'type' => 'motor',
                    'suppliers' => [
                        'supplier 1',
                    ],
                ]
            ]
        );

        $productController = new ProductController($comms);
        $result = $productController->getProductDetail('productId');

        $this->assertEquals(
            "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Product Detail</title>
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\"
          integrity=\"sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T\" crossorigin=\"anonymous\">
</head>
<body>
<div class=\"container\">
    <div class=\"card <div class=\" card border-primary
    \">
    <div class=\"card-body\">
        <h4 class=\"card-title\">Product Detail</h4><div>
    Name: product 1
</div>
<div>
    Description: product description
</div>
<div>
    Type: motor
</div>
<div>
    <p>Suppliers:</p>
    <ul class=\"list-group list-group-flush\">
                    <li class=\"list-group-item\">supplier 1</li>
            </ul>
</div>
<nav justify-content-center\">
<a class=\"nav-link active\" href=\"/\">Return to list</a>
</nav>
</div>
</div>
<script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\"
        integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\"
        crossorigin=\"anonymous\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\"
        integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\"
        crossorigin=\"anonymous\"></script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\"
        integrity=\"sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM\"
        crossorigin=\"anonymous\"></script>
</body>\n",
            $result
        );
    }
}
