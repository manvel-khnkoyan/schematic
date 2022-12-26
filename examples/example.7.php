<?php

namespace MyExample;

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Trebel\Schematic\Operators;
use Trebel\Schematic\Tools\Exporter;

$car = new Schemas\Car([
    new Fields\Car\ID(31),
    new Operators\Increase(5000),
]);

$exporter = new Exporter($car);
$exporter->export('/tmp/schematic', ['action' => 'true']);

echo "OK\n";