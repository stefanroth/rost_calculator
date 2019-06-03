<?php

namespace Drupal\rost_calculator\Calculator;

class Multiply extends Word implements OperatorInterface
{
    use OperatorTrait;

    public static function regexPattern() : string
    {
        return '/\*/';
    }

    public function executeOrder(): int
    {
        return 2;
    }

    public function calculate($value1, $value2) : int
    {
        return $value1 * $value2;
    }
}
