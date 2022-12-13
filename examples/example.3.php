<?php

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Examples\Lists;

$carOne = new Schemas\Car([
    'id' => new Fields\CarId(32),
    'name' => new Fields\CarName('Bmw'),
]);

/*
$carTwo = new Schemas\Car([
    'id' => new Fields\CarId(31),
    'name' => new Fields\CarName('Mercedes-Benz'),
]);

$userTwo = new Schemas\Person([
    'id' => new Fields\UserId(16),
    'name' => new Fields\UserName('Alan'),
]);

*/

$cars = new Lists\Persons([$carOne]);

echo "OK\n";
