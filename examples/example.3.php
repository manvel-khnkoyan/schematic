<?php

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Examples\Lists;

$carOne = new Schemas\Car([
    new Fields\Car\ID(32),
    new Fields\Car\Name('Bmw'),
    new Fields\Car\Price(15000),
]);

$carTwo = new Schemas\Car([
    new Fields\Car\ID(31),
    new Fields\Car\Name('Mercedes-Benz'),
    new Fields\Car\Price(54000),
]);

$carToyota = new Schemas\Toyota([
    new Fields\Car\ID(31),
    new Fields\Car\Name('Mercedes-Benz'),
    new Fields\Car\Price(14000),
]);

$userTwo = new Schemas\Person([
    new Fields\User\ID(16),
    new Fields\User\Name('Alan'),
]);

$cars = new Lists\Cars([
    $carOne, $carTwo, $carToyota /*, $userTwo */
]);

try {
    $cars2 = new Lists\Cars(
        [$carOne, $carTwo, $carToyota, $userTwo
    ]);
}  catch (Exception $e) {
    echo "OK\n";
}

