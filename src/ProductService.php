<?php

namespace Aryaadhiprasetyo\Phpunittest;

use Exception;
use Aryaadhiprasetyo\Phpunittest\ProductRepository;

class ProductService
{
    public function __construct(private ProductRepository $productRepository) {}

    public function register(Product $product): Product
    {
        if ($this->productRepository->findById($product->id) != null) {
            throw new Exception("Product with ID {$product->id} already exists.");
        }

        return $this->productRepository->save($product);
    }
}
