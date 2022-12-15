<?php

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Examples\Lists;

$carOne = new Schemas\Car([
    'id' => new Fields\CarId(32),
    'name' => new Fields\CarName('Bmw'),
    'price' => new Fields\CarPrice(15000),
]);

$carTwo = new Schemas\Car([
    'id' => new Fields\CarId(31),
    'name' => new Fields\CarName('Mercedes-Benz'),
    'price' => new Fields\CarPrice(54000),
]);


$carToyota = new Schemas\Toyota([
    'id' => new Fields\CarId(31),
    'name' => new Fields\CarName('Mercedes-Benz'),
    'price' => new Fields\CarPrice(14000),
]);

$userTwo = new Schemas\Person([
    'id' => new Fields\UserId(16),
    'name' => new Fields\UserName('Alan'),
]);

$cars = new Lists\Cars([$carOne, $carTwo, $carToyota /*, $userTwo */]);

echo "OK\n";
