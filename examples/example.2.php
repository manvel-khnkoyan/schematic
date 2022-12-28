<?php

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Examples\Lists;

$userOne = new Schemas\Person([
    new Fields\User\ID(123),
    new Fields\User\Name('Jhone'),
]);

$userTwo = new Schemas\Person([
    new Fields\User\ID(16),
    new Fields\User\Name('Alan'),
]);

$persons = new Lists\Persons([
    $userOne, $userTwo
]);

echo "OK\n";