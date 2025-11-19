<?php

namespace Aryaadhiprasetyo\Phpunittest;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Depends;
use Aryaadhiprasetyo\Phpunittest\Counter;
use PHPUnit\Framework\Attributes\After;
use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\DataProvider;

class CounterTest extends TestCase
{
    private Counter $counter;

    // protected function setUp(): void
    // {
    //     parent::setUp();

    //     $this->counter = new Counter();
    // }

    #[Before()]
    public function createCounter(): void
    {
        $this->counter = new Counter();
    }

    #[After()]
    public function after()
    {
        echo 'Test Completed';
    }

    public function testIncrement()
    {
        $this->counter->increment();

        self::assertEquals(1, $this->counter->getCount());
    }

    #[Test]
    public function example()
    {
        self::assertTrue(true);
    }

    #[Test]
    public function first()
    {
        $this->counter->increment();

        self::assertEquals(1, $this->counter->getCount());

        return $this->counter;
    }

    #[Test]
    #[Depends('first')]
    public function second(Counter $counter)
    {
        $counter->increment();

        self::assertEquals(2, $counter->getCount());
    }

    #[Test]
    #[DataProvider('mathSum')]
    public function sumProvider(array $numbers, int $expectedSum,)
    {
        self::assertEquals($expectedSum, Math::sum($numbers));
    }

    public static function mathSum()
    {
        return [
            [[1, 2, 3], 6],
            // [[0, 0, 0], 0],
            // [[-1, 1, 0], 0],
            // [[5, 10, 15], 30],
        ];
    }
}
