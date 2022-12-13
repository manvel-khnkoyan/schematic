<?php

namespace Examples\Schemas;

use Peeghe\Schematic\Schema;

class Person extends Schema {
    function __construct(...$args) {
        parent::__construct(...$args);
    }

    protected $__schema = [
        'id' => 'Examples\Fields\UserId',
        'name' => 'Examples\Fields\UserName',
    ];
}
