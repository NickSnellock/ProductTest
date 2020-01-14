<?php

namespace Tests\Entities;

use App\Entities\Product;
use App\Entities\ProductTypeEnum;
use PHPUnit\Framework\TestCase;
use Tests\PHPUnitUtil;

class ProductTest extends TestCase
{
    public function testSettersAndGetters()
    {
        $productType = ProductTypeEnum::MOTOR();

        $product = new Product('product name', 'product description', $productType, ['supplier 1']);

        $this->assertEquals('product name', PHPUnitUtil::getProperty($product, 'name'));
        $this->assertEquals('product description', PHPUnitUtil::getProperty($product, 'description'));
        $this->assertEquals(ProductTypeEnum::MOTOR(), PHPUnitUtil::getProperty($product, 'type'));
        $this->assertIsArray(PHPUnitUtil::getProperty($product, 'suppliers'));
        $this->assertEquals(['supplier 1'], PHPUnitUtil::getProperty($product, 'suppliers'));

        $product->setName('new product name');
        $product->setDescription('new description');
        $product->setSuppliers(['supplier 1', 'supplier 2']);

        $this->assertEquals('new product name', PHPUnitUtil::getProperty($product, 'name'));
        $this->assertEquals('new description', PHPUnitUtil::getProperty($product, 'description'));
        $this->assertIsArray(PHPUnitUtil::getProperty($product, 'suppliers'));
        $this->assertEquals(['supplier 1', 'supplier 2'], PHPUnitUtil::getProperty($product, 'suppliers'));

        $this->assertEquals('new product name', $product->getName());
        $this->assertEquals('new description', $product->getDescription());
        $this->assertEquals(ProductTypeEnum::MOTOR(), $product->getType());
        $this->assertIsArray($product->getSuppliers());
        $this->assertEquals(['supplier 1', 'supplier 2'], $product->getSuppliers());
    }
}
