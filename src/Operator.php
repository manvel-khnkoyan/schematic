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
}
