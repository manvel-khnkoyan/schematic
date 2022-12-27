<?php

namespace Examples\Schemas;

use Trebel\Schematic\Schema;

class Person extends Schema {
    function __construct(...$args) {
        parent::__construct(...$args);
    }

    public $__schema = [
        'Examples\Fields\User\ID',
        'Examples\Fields\User\Name',
        'Examples\Lists\Cars',
    ];
}
