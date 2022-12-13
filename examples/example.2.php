<?php

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Examples\Lists;

$userOne = new Schemas\Person([
    'id' => new Fields\UserId(15),
    'name' => new Fields\UserName('Jhone'),
]);

$userTwo = new Schemas\Person([
    'id' => new Fields\UserId(16),
    'name' => new Fields\UserName('Alan'),
]);

$persons = new Lists\Persons([$userOne, $userTwo]);

echo "OK\n";