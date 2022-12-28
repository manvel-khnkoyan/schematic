<?php

namespace Examples\Fields\Car;

use Trebel\Schematic\Field;

/**
 * [Description Price]
 */
class Price extends Field {
    static public $operators = [
        'Trebel\Schematic\Operators\Increase'
    ];

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
        return is_numeric($value);
    }
}
