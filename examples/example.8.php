<?php

require __DIR__ . '/../vendor/autoload.php';

use Trebel\Schematic\Tools;

$importer = new Tools\Importer([
    'Examples\Schemas\Car',
    'Examples\Schemas\Person',
    'Examples\Schemas\Toyota',
]);

$result = $importer->import('/tmp/schematic/car/31/Car/31.xml');
print_r($result);

echo "OK\n";