<?php

namespace Example;

use Peegh\Schematic\Schema;

class Person extends Schema {
    function __construct(...$args){
        parent::__construct(...$args);
    }

    protected $__schema = [
        'id' => 'Example\Fields\UserId',
        'name' => 'Example\Fields\UserName',
    ];
}
