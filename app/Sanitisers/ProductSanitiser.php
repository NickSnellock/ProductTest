<?php

namespace App\Sanitisers;

use App\Entities\Product;

class ProductSanitiser
{
    public static function sanitise(Product $product): Product
    {
        $product->setName(StringSanitiser::sanitise($product->getName()));
        $product->setDescription(StringSanitiser::sanitise($product->getDescription()));
        $sanitisedSuppliers = [];
        if (is_array($product->getSuppliers())) {
            foreach ($product->getSuppliers() as $supplier) {
                $sanitisedSuppliers[] = StringSanitiser::sanitise($supplier);
            }
            $product->setSuppliers($sanitisedSuppliers);
        }

        return $product;
    }
}