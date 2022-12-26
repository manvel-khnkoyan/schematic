<?php

namespace MyExample;

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Trebel\Schematic\Operators;

$carTwo = new Schemas\Car([
    new Fields\Car\ID(31),
    new Fields\Car\Price(
        new Operators\Increase(123),
    )
]);

echo "OK\n";