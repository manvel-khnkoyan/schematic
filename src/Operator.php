<?php

namespace Trebel\Schematic;

use Trebel\Schematic\Property;

/**
 * [Description Operator]
 */
abstract class Operator extends Property {
    protected $value = null;

    /**
     * @param mixed $value
     */
    function __construct($value) {
        $this->value = $value;
    }

    /**
     * @param mixed $item
     * 
     * @return void
     */
    public function validateType($item): void {
        if (!isset($item::$operators) || !in_array(get_class($this), $item::$operators) ) {
            throw new  \Exception(
                "[" . get_class($item) . "] doesn't have [" . get_class($this) . "] operator"
            );
        }
    }

    /*
     * Get Operator Inner Item 
     * @return [type]
     */
    public function innerItem() {
        return $this->value;
    }
}
