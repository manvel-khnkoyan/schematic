<?php

namespace Peegh\Schematic;

use Peegh\Schematic\Interfaces\Property;

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
            throw new \Exception("Invalid value: " . print_r($value, true) . " for ".get_class($this));
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
