<?php

namespace MyExample;

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Xnko\Schematic\Operators;
use Xnko\Schematic\Tools\Exporter;

$car = new Schemas\Car([
    'id' => new Fields\Car\ID(31),
    'price' => new Operators\Increase(5000),
]);

$exporter = new Exporter($car);
$exporter->export('/tmp/schematic', ['action' => 'true']);

echo "OK\n";