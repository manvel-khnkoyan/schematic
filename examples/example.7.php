<?php

namespace MyExample;

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Examples\Lists;

$userOne = new Person([
    'id' => new UserId(1234),
    'name' => new UserName('Jhone'),
]);


$userOne = new Person([
    'id' => new UserId(1234),
    'name' => new UserName('Jhone'),
    'type' => new Persons([
        new Operators\Push(),
        new Operators\Pull(),
    ]),
]);


echo $userOne->id->value();

