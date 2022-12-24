<?php

namespace Examples\Fields\Car;

use Xnko\Schematic\Field;

class Price extends Field {

    public $operators = [
        'Xnko\Schematic\Operators\Increase'
    ];

    function __construct($value) {
        parent::__construct($value);
    }

    public function validate($value): bool {
        return is_numeric($value);
    }
}