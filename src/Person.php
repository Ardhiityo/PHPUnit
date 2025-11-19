<?php

namespace Aryaadhiprasetyo\Phpunittest;

use Exception;

class Person
{
    public function sayHello(string|null $name)
    {
        if (empty($name)) {
            throw new Exception('Name is required');
        }

        return "Hello $name";
    }

    public function sayGoodBye(string $name)
    {
        echo "Goodbye $name";
    }
}
