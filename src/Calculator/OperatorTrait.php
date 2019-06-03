<?php

namespace Drupal\rost_calculator\Calculator;

trait OperatorTrait
{
    /**
     * @param array $context
     * @param int $index
     * @return array
     * @throws \Exception
     */
    public function calculateAndReplace(array $context, int $index): array
    {
        $left = $context[$index - 1];
        $right = $context[$index + 1];
        if (!$left instanceof Number || !$right instanceof Number) {
            throw new \Exception('Calculation is not valid');
        }
        array_splice($context, $index - 1, 3, [new Number($context[$index]->calculate($left->value(), $right->value()))]);
        return array_values($context);
    }
}
