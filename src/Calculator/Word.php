<?php

namespace Drupal\rost_calculator\Calculator;

abstract class Word
{
    protected $identifyer;

    abstract public static function regexPattern() : string;

    /**
     * Sets the order of execution. A higher execute order is executed before a lower execute order.
     *
     * @return int
     */
    abstract public function executeOrder() : int;

    /**
     * Returns an ordered array with all occurences of the regexPattern, the index representing the offset of the
     * occurrence.
     *
     * @param string $input
     * @return array
     */
    public static function orderedArray(string $input) : array
    {
        /** @var Word $className */
        $className = get_called_class();
        $matches = [];
        if (0 === preg_match_all($className::regexPattern(), $input, $matches, PREG_OFFSET_CAPTURE)) {
            return [];
        }

        $result = [];

        foreach ($matches[0] as $match) {
            $result[$match[1]] = new $className($match[0]);
        }
        return $result;
    }

    public function __construct(string $identifyer)
    {
        $this->identifyer = $identifyer;
    }
}
