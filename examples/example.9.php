<?php

require __DIR__ . '/../vendor/autoload.php';

use Examples\Schemas;
use Examples\Fields;
use Examples\Lists;
use Trebel\Schematic\Operators;
use Trebel\Schematic\Tools;

/*
 * */
$filePath = '/tmp/schematic/Example.9/index.xml';

/*
* Export Data */
$schema = new Tools\Exporter(
    new Schemas\Person([
        new Fields\User\ID(15),
        new Lists\Cars([
            new Operators\Push(
                new Schemas\Car([
                    new Fields\Car\ID(33),
                    new Fields\Car\Name('Ford'),
                    new Fields\Car\Price(15000)
                ])
            ),
            new Operators\Pull( new Schemas\Car([
                new Fields\Car\ID(31)]
            )),
        ])
    ])
);
$schema->export($filePath, ['action' => 'Update']);

/*
* Import */
$importedSchema = (new Tools\Importer([
    'Examples\Schemas\Car',
    'Examples\Schemas\Person',
    'Examples\Schemas\Toyota',
]))->import($filePath);

echo "OK\n";