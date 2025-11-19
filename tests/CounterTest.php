<?php

namespace Aryaadhiprasetyo\Phpunittest;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Depends;
use Aryaadhiprasetyo\Phpunittest\Counter;
use PHPUnit\Framework\Attributes\DataProvider;

class CounterTest extends TestCase
{
    public function testIncrement()
    {
        $counter = new Counter();

        $counter->increment();

        self::assertEquals(1, $counter->getCount());
    }

    #[Test]
    public function example()
    {
        self::assertTrue(true);
    }

    #[Test]
    public function first()
    {
        $counter = new Counter();

        $counter->increment();

        self::assertEquals(1, $counter->getCount());

        return $counter;
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
