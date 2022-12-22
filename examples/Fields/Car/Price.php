<?php

namespace Examples\Fields\Car;

use Peeghe\Schematic\Field;

class Price extends Field {
    function __construct($value) {
        parent::__construct($value);
    }

    public function validate($value): bool {
        return is_numeric($value);
    }
}