<?php

namespace Drupal\rost_calculator\Calculator;

class Calculator
{
    const MAX_EXECUTE_ORDER = 2;

    /**
     * Takes calculation string and returns result or Error if calculation string is not valid.
     *
     * @param string|null $input
     * @return string
     * @throws \Exception
     */
    public function execute(string $input = null) : string
    {
        if ($input == null) {
            return '';
        }

        try {
            $calculation = $this->calculateRecursively($this->parse($input), self::MAX_EXECUTE_ORDER);
            return (string) $calculation[0]->value();
        } catch (\Exception $e) {
            if ($e instanceof InvalidCalculationException) {
                return $e->getMessage();
            } else {
                throw $e;
            }
        }
    }

    /**
     * Parse the input string and return an array of Words.
     *
     * @param string $input
     * @return array
     */
    private function parse(string $input) : array
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

    /**
     * Execute all calculations of the operators until there is only one number left.
     *
     * @param array $elements
     * @param int $executeOrder
     * @return array
     */
    private function calculateRecursively(array $elements, int $executeOrder)
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
