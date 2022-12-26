<?php

namespace Trebel\Schematic;

use Trebel\Schematic\Property;

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
    public function validateType($item): void {
        if (!isset($item->operators) || !in_array(get_class($this), $item->operators)) {
            throw new  \Exception(
                "[".get_class($item)."] doesn't have [".get_class($this)."] operator"
            );
        }
    }

    /*
    * Get Operator Inner Item */
    public function innerItem()
    {
        return $this->value;
    }
}
