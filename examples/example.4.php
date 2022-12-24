<?php

namespace MyExample;

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Examples\Lists;
use Xnko\Schematic\Operators;

$userOne = new Schemas\Person([
    new Fields\User\ID(15),
    new Fields\User\Name('Jhone'),
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

