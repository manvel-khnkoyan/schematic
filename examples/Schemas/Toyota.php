<?php

namespace Examples\Schemas;

use Examples\Schemas\Car;

class Toyota extends Car {
    function __construct(...$args) {
        parent::__construct(...$args);
    }
}
