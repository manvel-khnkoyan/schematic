<?php

namespace Peeghe\Schematic;

use Peeghe\Schematic\Interfaces\Property;

/*
 * It coukld be eather primitiv eather 
 * non primitiv values */
abstract class Field implements Property {
    protected $value;
    protected $operators = [];
    abstract protected function validate($value): bool;

    public function validateType($type) : bool {
        return is_a($this, $type);
    }

    function __construct($value) {
        if (!$this->validate($value)) {
            throw new \Exception(
                "Oops invalid Field is provided: $value"
            );
        }
        $this->value = $value;
    }

    public function __toString() {
        return $this->value;
    }

    public function value() {
        return $this->value;
    }
}
