<?php

namespace Xnko\Schematic\Operators;
use Xnko\Schematic\Operator;

class Push extends Operator {
    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
    
    public function validateType($type): bool {
        // Call parent function
        if (!parent::validateType($type)) return false;
        
        // Check if List Type is the same as Operator item
        if ($type !== get_class($this->value)) {
            return false;
        }

        // Pull operator must be completed object
        if (!$this->value->isCompleted()) {
            return false;
        }

        return true;
    }
}