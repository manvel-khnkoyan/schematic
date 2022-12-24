<?php

namespace Xnko\Schematic;

use Xnko\Schematic\Property;

abstract class Operator extends Property
{
    protected $value = null;

    /*
     * Constructor */
    function __construct($value)
    {
        $this->value = $value;
    }

    // Call parent function
    public function validateType($type): bool {
        return isset($type->operators) && in_array(get_class($this), $type->operators);
    }

    /*
    * Get Operator Inner Item */
    public function innerItem()
    {
        return $this->value;
    }
}
