<?php

namespace Peeghe\Schematic;

use Peeghe\Schematic\Property;

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
        if (!$this->validate($value)) {
            throw new \Exception(
                "Invalid value: [$value] given for " . get_class($this)
            );
        }
    }

    public function __toString()
    {
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
