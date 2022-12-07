<?php

namespace Peeghe\Schematic\Operators;

use Peeghe\Schematic\Operator;

class Increase extends Operator {
    public function validate($value) : bool {
        return is_numeric($value);
    }
}