<?php

namespace Peeghe\Schematic\Operators;
use Peeghe\Schematic\Operator;

class Push extends Operator {
    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
    
    public function validateReference($type): bool {
        /*
         * List should have same type of operator */
        if ($type !== get_class($this->value)) {
            return false;
        }

        /*
         * Pull operator must be completed object */
        if (!$this->value->isCompleted()) {
            return false;
        }

        return true;
    }
}