<?php

namespace Examples\Schemas;

use Peeghe\Schematic\Schema;

class Car extends Schema {
    function __construct(...$args) {
        parent::__construct(...$args);
    }

    protected $__schema = [
        'id' => 'Examples\Fields\CarId',
        'name' => 'Examples\Fields\CarName',
        'price' => 'Examples\Fields\CarPrice',
    ];
}
