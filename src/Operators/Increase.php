<?php

namespace Xnko\Schematic\Operators;

use Xnko\Schematic\Operator;

class Increase extends Operator {
    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
    
    public function validateType($type): bool {
        // Call parent function
        if (!parent::validateType($type)) return false;

        // Validate 
        return is_numeric($this->value);
    }
}