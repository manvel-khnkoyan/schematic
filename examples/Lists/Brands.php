<?php

namespace Examples\Lists;

use Xnko\Schematic\Collection;

class Brands extends Collection {
    protected $type = 'Examples\Fields\Car\Name';
    protected $operators = [
        'Xnko\Operators\Push'
    ];

    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
}
