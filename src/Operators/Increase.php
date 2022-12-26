<?php

namespace Trebel\Schematic\Operators;

use Trebel\Schematic\Operator;

class Increase extends Operator {
    function __construct(...$arg) {
        parent::__construct(...$arg);
    }

    public function validateType($type): void {
        // Call parent function
        parent::validateType($type);

        // Validate 
        if (!is_numeric($this->value)) {
            throw new \Exception("Increase operator value should be numeric for $type");
        }
    }
}
