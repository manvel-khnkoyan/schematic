<?php

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;

$user = new Schemas\Person([
    new Fields\User\ID(1234),
    new Fields\User\Name('Jhone'),
]);

// echo $user->ID ."\n";
// echo $user->Name ."\n";

echo "OK\n";
