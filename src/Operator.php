<?php

namespace Peeghe\Schematic;

use Peeghe\Schematic\Property;

abstract class Operator extends Property
{
    protected $value = null;

    /*
     * Constructor */
    function __construct($value)
    {
        $this->value = $value;
    }

    /*
    * Get Operator Inner Item */
    public function innerItem()
    {
        return $this->value;
    }
}
