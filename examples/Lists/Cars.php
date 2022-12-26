<?php

namespace Examples\Lists;

use Trebel\Schematic\Collection;

class Cars extends Collection {
    public $type = 'Examples\Schemas\Car';

    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
}
