<?php

namespace MyExample;

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Peeghe\Schematic\Operators;

$carTwo = new Schemas\Car([
    'id' => new Fields\CarId(31),
    'price' => new Operators\Increase(5000),
]);


echo "OK\n";