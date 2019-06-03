<?php

namespace Drupal\rost_calculator\Calculator;

class Number extends Word
{
    private $value;

    public static function regexPattern() : string
    {
        return '/[0-9]+/';
    }

    public function __construct(string $identifyer)
    {
        $this->value = (int) $identifyer;
        parent::__construct($identifyer);
    }

    public function value() : int
    {
        return (int) $this->value;
    }

    public function executeOrder(): int
    {
        return 0;
    }
}
