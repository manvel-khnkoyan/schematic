<?php

namespace Peegh\Schematic\Operators;

use Peegh\Schematic\Operator;

class Increase extends Operator {
    public function validate($value) : bool {
        return is_numeric($value);
    }
}