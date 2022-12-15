<?php

namespace MyExample;

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Examples\Lists;
use Peeghe\Schematic\Operators;

$userOne = new Schemas\Person([
    'id' => new Fields\UserId(15),
    'name' => new Fields\UserName('Jhone'),
]);

$userTwo = new Schemas\Person([
    'id' => new Fields\UserId(16),
    'name' => new Fields\UserName('Alan'),
]);

$userTree = new Schemas\Person([
    'id' => new Fields\UserId(18),
]);

$Persons = new Lists\Persons([
    new Operators\Push($userOne),
    new Operators\Pull($userTree),
]);


echo "OK\n";

