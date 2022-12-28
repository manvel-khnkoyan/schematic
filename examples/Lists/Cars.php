<?php

namespace Examples\Lists;

use Trebel\Schematic\Collection;

class Cars extends Collection {
    public $type = 'Examples\Schemas\Car';
    public static $operators = [
        'Trebel\Schematic\Operators\Push',
        'Trebel\Schematic\Operators\Pull',
    ];

    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
}
