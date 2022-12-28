<?php

require __DIR__ . '/../vendor/autoload.php';

use Trebel\Schematic\Tools;

$importer = new Tools\Importer([
    'Examples\Schemas\Car',
    'Examples\Schemas\Person',
    'Examples\Schemas\Toyota',
]);

$result = $importer->import('/tmp/schematic/car/Update/index.xml');
// var_dump($result);

echo "OK\n";