<?php

namespace Tests\Sanitisers;

use App\Entities\Product;
use App\Entities\ProductTypeEnum;
use App\Sanitisers\ProductSanitiser;
use App\Sanitisers\StringSanitiser;
use Mockery;
use PHPUnit\Framework\TestCase;

class ProductSanitiserTest extends TestCase
{
    /**
     * this test will only work correctly if run in isolation
     */
    public function testAllStringsSanitised()
    {
        $this->markTestSkipped();
        $stringSanitiser = Mockery::mock('alias:' . StringSanitiser::class);
        $stringSanitiser->shouldReceive('sanitise')->andReturn('slartybartfast');

        $product = new Product(
            'name',
            'description',
            ProductTypeEnum::MOTOR(),
            [
                'Supplier 1',
                'Supplier 2',
            ]
        );

        ProductSanitiser::sanitise($product);

        $this->assertEquals('slartybartfast', $product->getName());
        $this->assertEquals('slartybartfast', $product->getDescription());
        $this->assertEquals(['slartybartfast', 'slartybartfast'], $product->getSuppliers());
    }
}
