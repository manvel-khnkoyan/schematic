<?php

namespace Peeghe\Schematic\Operators;
use Peeghe\Schematic\Operator;

class Increase extends Operator {
    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
    
    public function validateReference($type): bool {
        return is_numeric($this->value);
    }
}