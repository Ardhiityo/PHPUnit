<?php

namespace Aryaadhiprasetyo\Phpunittest;

use Exception;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;

class PersonTest extends TestCase
{
    #[Test]
    public function success()
    {
        $person = new Person();

        self::assertEquals('Hello Arya', $person->sayHello('Arya'));
    }

    #[Test]
    public function exception()
    {
        $person = new Person();

        self::expectException(Exception::class);

        self::assertEquals('Hello Arya', $person->sayHello(null));
    }
}
