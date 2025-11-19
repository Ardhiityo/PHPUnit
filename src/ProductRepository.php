<?php

namespace Aryaadhiprasetyo\Phpunittest;

use Aryaadhiprasetyo\Phpunittest\Product;

interface ProductRepository
{
    public function findById(string $id): ?Product;
    public function save(Product $product): Product;
    public function delete(string $id): void;
    public function findAll(): array;
}
