<?php

namespace Xnko\Schematic;

use Xnko\Schematic\Property;
use Xnko\Schematic\Operator;

/*
 * It coukld be eather primitiv eather
 * non primitiv values */
abstract class Field extends Property
{
    protected $value = null;
    abstract protected function validate($value): bool;

    function __construct($value)
    {
        $this->value = $value;
        if ($this->value instanceof Property) {
            if (!$this->value->validateType($this)) {
                throw new \Exception(
                    "Field [" . get_class($this) . 
                    "] has invalid value: [" . 
                    get_class($this->value) . "]"
                );
            }
        } else if (!$this->validate($value)) {
            $val = is_scalar($this->value) 
                ? $value : get_class($value);
            throw new \Exception(
                "Invalid value: [$val] given in " . get_class($this)
            );
        }
    }

    public function __toString() {
        if (is_scalar($this->value)) {
            return $this->value;
        }
        return '['.get_class($this->value).']';
    }

    /*
    * Get Field Inner Item */
    public function innerItem() 
    {
        return $this->value;
    }
}
