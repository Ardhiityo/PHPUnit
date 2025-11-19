<?php

namespace Aryaadhiprasetyo\Phpunittest;

class Math
{
    public static function sum(array $numbers)
    {
        $total = 0;
        foreach ($numbers as $number) {
            $total += $number;
        }
        return $total;
    }
}
