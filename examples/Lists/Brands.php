<?php

namespace Examples\Lists;

use Peeghe\Schematic\Collection;

class Brands extends Collection {
    protected $type = 'Examples\Fields\CarName';

    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
}
