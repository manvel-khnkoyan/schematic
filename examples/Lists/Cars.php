<?php

namespace Examples\Lists;

use Peeghe\Schematic\Collection;

class Cars extends Collection {
    protected $type = 'Examples\Schemas\Car';

    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
}
