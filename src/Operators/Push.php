<?php

namespace Peeghe\Schematic\Operators;
use Peeghe\Schematic\Operator;
use Peeghe\Schematic\Schema;

class Push extends Operator {
    public function validate($value) : bool {
        return $value instanceof Schema;
    }
}