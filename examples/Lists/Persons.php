<?php

namespace Examples\Lists;

use Xnko\Schematic\Collection;

class Persons extends Collection {
    protected $type = 'Examples\Schemas\Person';
    protected $operators = [
        'Xnko\Schematic'
    ];

    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
}
