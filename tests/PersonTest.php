<?php

namespace Aryaadhiprasetyo\Phpunittest;

use Exception;
use PHPUnit\Framework\Attributes\RequiresOperatingSystem;
use PHPUnit\Framework\Attributes\RequiresPhp;
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

    #[Test]
    public function outputString()
    {
        $person = new Person();

        $person->sayGoodBye('eko');

        self::expectOutputString('Goodbye eko');
    }

    #[Test]
    public function example()
    {
        self::markTestSkipped('This test is skipped for demonstration purposes.');
    }

    #[Test]
    #[RequiresPhp('8.4')]
    #[RequiresOperatingSystem('Linux')]
    public function exampleRequire()
    {
        self::assertTrue(true);
    }
}
