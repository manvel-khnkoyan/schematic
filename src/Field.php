<?php

namespace Trebel\Schematic;

use Trebel\Schematic\Property;
use Trebel\Schematic\Operator;

/*
 * It coukld be eather primitiv eather
 * non primitiv values */

abstract class Field extends Property {
    protected $value = null;
    abstract protected function validate($value): bool;

    function __construct($value) {
        $this->value = $value;
        if ($this->value instanceof Operator) {
            return $this->value->validateType($this);
        }

        if (!$this->validate($value)) {
            $name = is_scalar($this->value) ? $value : get_class($value);
            throw new \Exception(
                "Invalid value: [$name] given in " . get_class($this)
            );
        }
    }

    public function __toString() {
        if (is_scalar($this->value)) {
            return $this->value;
        }
        return '[' . get_class($this->value) . ']';
    }

    /*
     * Get Field Inner Item */
    public function innerItem() {
        return $this->value;
    }
}
