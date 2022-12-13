<?php

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;

$userOne = new Schemas\Person([
    'id' => new Fields\UserId(1234),
    'name' => new Fields\UserName('Jhone'),
]);

echo "OK\n";