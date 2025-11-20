<?php

namespace Aryaadhiprasetyo\Phpunittest;

use PHPUnit\Framework\TestCase;
use Aryaadhiprasetyo\Phpunittest\ProductService;
use Aryaadhiprasetyo\Phpunittest\ProductRepository;
use Exception;
use PHPUnit\Framework\Attributes\Test;

class ProductServiceTest extends TestCase
{
    private ProductRepository $productRepository;
    private ProductService $productService;

    public function setUp(): void
    {
        parent::setUp();

        $this->productRepository = $this->createStub(ProductRepository::class);
        $this->productService = new ProductService($this->productRepository);
    }

    #[Test]
    public function stub()
    {
        $product = new Product(id: 'P001', name: 'Product 1', price: 10000);

        $this->productRepository->method('findById')->willReturn($product);

        $result = $this->productRepository->findById('P002');

        self::assertEquals($product, $result);
        self::assertEquals($product->id, $result->id);
    }

    #[Test]
    public function stubMap()
    {
        $product1 = new Product(id: 'P001', name: 'Product 1', price: 10000);
        $product2 = new Product(id: 'P002', name: 'Product 2', price: 20000);

        $map = [
            ['P001', $product1],
            ['P002', $product2],
        ];

        $this->productRepository->method('findById')->willReturnMap($map);

        $result = $this->productRepository->findById('P002');

        self::assertEquals($product2, $result);
        self::assertEquals($product2->id, $result->id);
        self::assertNotEquals($product1->id, $result->id);
    }

    #[Test]
    public function stubCallback()
    {
        $this->productRepository->method('findById')->willReturnCallback(function (string $id) {
            return new Product($id, 'Product', 1000);
        });

        $result = $this->productRepository->findById('P001');

        self::assertEquals('P001', $result->id);
        self::assertNotEquals('Products', $result->name);
    }

    #[Test]
    public function registerProductSuccess()
    {
        $product = new Product(id: 'P002', name: 'Product 2', price: 20000);

        $this->productRepository->method('findById')->willReturn(null);
        $this->productRepository->method('save')->willReturn($product);
        // $this->productRepository->method('save')->willReturnArgument(0);

        $result = $this->productService->register($product);

        self::assertEquals($product->id, $result->id);
        self::assertEquals($product->name, $result->name);
    }

    #[Test]
    public function registerProductFailed()
    {
        $product = new Product(id: 'P001', name: 'Product 1', price: 10000);

        $this->productRepository->method('findById')->willReturn($product);

        self::expectException(Exception::class);

        $this->productService->register($product);
    }
}
