<?php

namespace Examples\Schemas;

use Trebel\Schematic\Schema;

class Car extends Schema {
    function __construct(...$args) {
        parent::__construct(...$args);
    }

    public $__schema = [
        'Examples\Fields\Car\ID',
        'Examples\Fields\Car\Name',
        'Examples\Fields\Car\Price',
    ];
}
