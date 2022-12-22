<?php

namespace MyExample;

require __DIR__ . '/../vendor/autoload.php';

use Examples\Fields;
use Examples\Lists;


$carNames = new Lists\CarNames([
    new Fields\CarName('Mercedes-Benz'),
    new Fields\CarName('Bmw'),
]);


echo "OK\n";

