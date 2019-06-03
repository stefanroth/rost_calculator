<?php

namespace Drupal\rost_calculator\Calculator;

class Calculator
{
    protected $messageCenter;
    const MAX_EXECUTE_ORDER = 2;

    public function execute(string $input)
    {
        try {
            $calculation = $this->calculateRecursively($this->parse($input), self::MAX_EXECUTE_ORDER);
            return $calculation[0]->value();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function parse(string $input) : array
    {
        $words = Number::orderedArray($input)
            + Plus::orderedArray($input)
            + Minus::orderedArray($input)
            + Multiply::orderedArray($input)
            + Divide::orderedArray($input);
        ksort($words);

        // get rid of messed up indices
        return array_values($words);
    }

    public function calculateRecursively(array $elements, int $executeOrder)
    {
        for (; $executeOrder > 0; $executeOrder--) {
            for ($i = 0; $i < count($elements); $i++) {
                if ($elements[$i]->executeOrder() == $executeOrder) {
                    $elements = $elements[$i]->calculateAndReplace($elements, $i);
                    return $this->calculateRecursively($elements, $executeOrder);
                }
            }
        }
        return $elements;
    }
}
