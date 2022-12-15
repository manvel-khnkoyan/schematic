<?php

namespace Peeghe\Schematic\Operators;

use Peeghe\Schematic\Operator;

class Pull extends Operator {
    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
    
    public function validateReference($type): bool {

        if ($type !== get_class($this->value)) {
            return false;
        }

        return true;
    }
}