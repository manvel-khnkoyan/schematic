<?php

namespace Peegh\Schematic;

use Peegh\Schematic\Interfaces\Property;

abstract class Operator implements Property {
    abstract protected function validate($value): bool;

    function __construct($value) {
        $this->validate($value);
    }

    public function validateType($originType) : bool {
        return in_array(get_class($this), $originType::$operators);
    }
}
