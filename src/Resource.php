<?php

namespace Peegh\Schematic;

use Peegh\Schematic\Interfaces\Property;

abstract class Resource implements Property {
    abstract function copyTo(String $path);
    abstract function open();

    function __construct() {
        
    }

    public function validateType($originType) : bool {
        return is_a($this, $originType);
    }
}
