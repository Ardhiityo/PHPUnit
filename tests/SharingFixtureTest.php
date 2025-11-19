<?php

namespace Aryaadhiprasetyo\Phpunittest;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class SharingFixtureTest extends TestCase
{
    private static Counter $counter;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$counter = new Counter();
    }

    #[Test]
    public function first()
    {
        self::$counter->increment();

        self::assertEquals(1, self::$counter->getCount());
    }

    #[Test]
    public function second()
    {
        self::$counter->increment();

        self::assertEquals(2, self::$counter->getCount());
    }
}
