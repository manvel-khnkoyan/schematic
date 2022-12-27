<?php

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Examples\Lists;
use Trebel\Schematic\Operators;
use Trebel\Schematic\Tools\Exporter;

$user = new Schemas\Person([
    new Fields\User\ID(15),
    new Fields\User\Name('Jhone'),
    new Lists\Cars([
        new Schemas\Car([
            new Fields\Car\ID(31),
            new Fields\Car\Name('Ford'),
            new Fields\Car\Price(15000)
        ])
    ])
]);

$exporterOne = new Exporter($user);
$exporterOne->export('/tmp/schematic/user/15', ['action' => 'Create']);


$car = new Schemas\Car([
    new Fields\Car\ID(31),
    new Fields\Car\Price(
        new Operators\Increase(5000)    
    )
]);

$exporterTwo = new Exporter($car);
$exporterTwo->export('/tmp/schematic/car/31', ['action' => 'Update']);


echo "OK\n";