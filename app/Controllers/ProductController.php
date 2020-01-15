<?php

namespace App\Controllers;

use App\Comms\Comms;
use App\Entities\Product;
use App\Entities\ProductTypeEnum;
use App\Exceptions\ProductListException;
use App\Sanitisers\ProductSanitiser;
use App\Sanitisers\StringSanitiser;
use Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ProductController
{
    /**
     * @var Comms
     */
    private $comms;

    /**
     * @var FilesystemLoader
     */
    private $loader;

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Comms $comms)
    {
        $this->loader = new FilesystemLoader(__DIR__ . '/../../twigs');
        $this->twig = new Environment($this->loader);
        $this->comms = $comms;
    }

    public function getProductList()
    {
        try {
            $productListArray = $this->comms->getList();
        } catch (ProductListException $ex) {
            error_log('Unable to retrieve list of products');
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
        foreach ($productListArray as $productId => $product) {
            $productListArray[$productId] = StringSanitiser::sanitise($product);
        }

        return $this->twig->render('productList.twig', ['products' => $productListArray, 'title' => 'Product List']);
    }

    public function getProductDetail(string $productKey)
    {
        try {
            $productArray = $this->comms->getProductDetail($productKey)[$productKey];
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }

        $productTypeString = strtoupper($productArray['type']);
        try {
            $productType = ProductTypeEnum::$productTypeString();
        } catch (Exception $ex) {
            $productType = null;
            error_log('Product ' . $productKey . ' has an invalid product type');
        }
        $product = ProductSanitiser::sanitise(new Product($productArray['name'], $productArray['description'],
            $productType, $productArray['suppliers']));

        return $this->twig->render(
            'productDetail.twig',
            [
                'title' => 'Product Detail',
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'type' => $product->getType(),
                'suppliers' => $product->getSuppliers(),
            ]
        );
    }
}