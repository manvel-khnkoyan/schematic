<?php

namespace Peeghe\Schematic;

use Peeghe\Schematic\Interfaces\Property;

abstract class Operator implements Property {
    abstract protected function validate($value): bool;

    function __construct($value) {
        $this->validate($value);
    }

    public function validateReference($type): bool {
        return in_array(get_class($this), $type::$operators);
    }
}
