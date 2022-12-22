<?php

namespace MyExample;

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Peeghe\Schematic\Operators;
use Peeghe\Schematic\Tools\Exporter;

$car = new Schemas\Car([
    'id' => new Fields\CarId(31),
    'price' => new Operators\Increase(5000),
]);

$exporter = new Exporter($car);
$exporter->export('/tmp/schematic', ['action' => 'true']);

echo "OK\n";