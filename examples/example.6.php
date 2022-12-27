<?php

require __DIR__ . '/../vendor/autoload.php';

use Examples\Fields;
use Examples\Lists;

$carNames = new Lists\Brands([
    new Fields\Car\Name('Mercedes-Benz'),
    new Fields\Car\Name('Bmw'),
]);

echo "OK\n";

