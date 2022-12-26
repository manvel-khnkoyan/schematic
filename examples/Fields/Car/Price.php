<?php

namespace Examples\Fields\Car;

use Trebel\Schematic\Field;

class Price extends Field {

    public $operators = [
        'Trebel\Schematic\Operators\Increase'
    ];

    function __construct($value) {
        parent::__construct($value);
    }

    public function validate($value): bool {
        return is_numeric($value);
    }
}
