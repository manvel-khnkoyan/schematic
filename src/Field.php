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
                "For " .
                    get_class($this) .
                    " Field invalid value provided: " .
                    get_class($value)
            );
        }
    }

    public function __toString()
    {
        return $this->value;
    }

    public function __invoke()
    {
        return $this->value;
    }
}
