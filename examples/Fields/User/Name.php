<?php

namespace Examples\Fields\User;

use Trebel\Schematic\Field;

/**
 * [Description Name]
 */
class Name extends Field {
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
        return is_string($value) && strlen($value) > 0 && strlen($value) < 255;
    }
}
