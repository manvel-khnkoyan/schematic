<?php

namespace Examples\Fields\Car;

use Trebel\Schematic\Field;

/**
 * [Description ID]
 */
class ID extends Field {
    /**
     * @param mixed $value
     */
    function __construct($value) {
        parent::__construct($value);
    }

    /**
     * @param mixed $value
     * 
     * @return bool
     */
    public function validate($value): bool {
        return (is_int($value) || ctype_digit($value)) && $value > 0;
    }
}
