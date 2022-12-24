<?php

namespace Examples\Schemas;

use Xnko\Schematic\Schema;

class Person extends Schema {
    function __construct(...$args) {
        parent::__construct(...$args);
    }

    protected $__schema = [
        'Examples\Fields\User\ID',
        'Examples\Fields\User\Name',
    ];
}
