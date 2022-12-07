<?php

namespace Peegh\Schematic\Operators;
use Peegh\Schematic\Operator;
use Peegh\Schematic\Schema;

class Push extends Operator {
    public function validate($value) : bool {
        return $value instanceof Schema;
    }
}