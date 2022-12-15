<?php

namespace Examples\Fields;

use Peeghe\Schematic\Field;

class CarPrice extends Field {
    function __construct($value) {
        parent::__construct($value);
    }

    public function validate($value): bool {
        return is_numeric($value);
    }
}