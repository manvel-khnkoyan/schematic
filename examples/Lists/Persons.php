<?php

namespace Examples\Lists;

use Peeghe\Schematic\Collection;

class Persons extends Collection {
    protected $type = 'Examples\Schemas\Person';

    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
}
