<?php

namespace Peeghe\Schematic\Operators;
use Peeghe\Schematic\Operator;
use Peeghe\Schematic\Schema;

class Pull extends Operator {
    public function validateReference($type): bool {
        return $value instanceof Schema;
    }
}