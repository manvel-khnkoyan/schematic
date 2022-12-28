<?php

namespace Examples\Lists;

use Trebel\Schematic\Collection;

class Brands extends Collection {
    public $type = 'Examples\Fields\Car\Name';
    public static $operators = [
        'Trebel\Operators\Push'
    ];

    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
}
