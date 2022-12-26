<?php

namespace Examples\Fields\Car;

use Trebel\Schematic\Field;

class ID extends Field {
    function __construct($value) {
        parent::__construct($value);
    }

    public function validate($value): bool {
        return (is_int($value) || ctype_digit($value)) && $value > 0;
    }
}