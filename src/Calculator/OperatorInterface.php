<?php

namespace Drupal\rost_calculator\Calculator;

interface OperatorInterface
{
    /**
     * @param $value1
     * @param $value2
     * @return int
     */
    public function calculate($value1, $value2) : int;
}
