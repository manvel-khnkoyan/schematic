<?php

namespace Trebel\Schematic\Operators;

use Trebel\Schematic\Operator;

/**
 * Increase operator,
 */
class Increase extends Operator {
    /**
     * @param mixed ...$arg
     */
    function __construct(...$arg) {
        parent::__construct(...$arg);
    }

    /**
     * @param mixed $type
     * 
     * @return void
     */
    public function validateType($type): void {
        // Call parent function
        parent::validateType($type);

        // Validate 
        if (!is_numeric($this->value)) {
            throw new \Exception("Increase operator value should be numeric for $type");
        }
    }
}
