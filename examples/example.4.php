<?php

namespace MyExample;

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Examples\Lists;
use Trebel\Schematic\Operators;

$userOne = new Schemas\Person([
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

$userTwo = new Schemas\Person([
    new Fields\User\ID(16),
    new Fields\User\Name('Alan'),
]);

$userTree = new Schemas\Person([
    new Fields\User\ID(18),
]);

$Persons = new Lists\Persons([
    new Operators\Push($userOne),
    new Operators\Pull($userTree),
]);


try {
    $Persons = new Lists\Persons([
        new Operators\Push($userTree)
    ]);
}  catch (\Exception $e) {
    echo "OK\n";
}

