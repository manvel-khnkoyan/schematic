<?php

namespace Peegh\Schematic\Lists;

use Peegh\Schematic\Collection;

class Operators extends Collection {
    protected $type = 'Peegh\Schematic\Operator';

    function __construct(...$arg) {
        parent::__construct(...$arg);
    }

    public function validate($item) {
        if (!is_a($item, 'Peegh\Schematic\Operators\Push') || !is_a($item, 'Peegh\Schematic\Operators\Pull')) {
            throw new \Exception('Oops, operator ['.print_r($item, true).'] provided operators');
        }
    }
}
