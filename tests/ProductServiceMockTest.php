<?php

namespace Aryaadhiprasetyo\Phpunittest;

use PHPUnit\Framework\TestCase;
use Aryaadhiprasetyo\Phpunittest\ProductService;
use Aryaadhiprasetyo\Phpunittest\ProductRepository;
use Exception;
use PHPUnit\Framework\Attributes\Test;

class ProductServiceMockTest extends TestCase
{
    private ProductRepository $productRepository;
    private ProductService $productService;

    public function setUp(): void
    {
        parent::setUp();

        $this->productRepository = $this->createMock(ProductRepository::class);
        $this->productService = new ProductService($this->productRepository);
    }

    #[Test]
    public function mock()
    {
        $product = new Product(id: 'P002', name: 'Product 2', price: 20000);

        $this->productRepository->expects(self::once())
            ->method('findById')
            ->willReturn($product);

        $result = $this->productRepository->findById('P002');
        //akan error karena melebihi ekspektasi self::once()
        // $result = $this->productRepository->findById('P002');

        self::assertEquals($product->id, $result->id);
    }

    #[Test]
    public function registerSuccess()
    {
        $product = new Product(id: 'P002', name: 'Product 2', price: 20000);

        $this->productRepository->expects(self::once())
            ->method('findById')
            ->willReturn(null);

        $this->productRepository->expects(self::once())
            ->method('save')
            ->willReturn($product);

        $result = $this->productService->register($product);

        self::assertEquals($product->id, $result->id);
    }

    #[Test]
    public function registerFailed()
    {
        $product = new Product(id: 'P002', name: 'Product 2', price: 20000);

        $this->productRepository->expects(self::once())
            ->method('findById')
            ->willReturn($product);

        $this->productRepository->expects(self::never())
            ->method('save');

        self::expectException(Exception::class);

        $this->productService->register($product);
    }

    #[Test]
    public function registerSuccessWithParam()
    {
        $product = new Product(id: 'P002', name: 'Product 2', price: 20000);
        $product2 = new Product(id: 'P003', name: 'Product 2', price: 20000);

        $this->productRepository->expects(self::once())
            ->method('findById')
            ->with(self::equalTo($product->id))
            ->willReturn(null);

        $this->productRepository->expects(self::once())
            ->method('save')
            ->with(self::equalTo($product))
            ->willReturn($product);

        $result = $this->productService->register($product);
        //akan error karena parameter tidak sesuai ekspektasi
        // $result = $this->productService->register($product2);

        self::assertEquals($product->id, $result->id);
    }
}
