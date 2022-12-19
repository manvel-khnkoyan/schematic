<?php

namespace Peeghe\Schematic\Tools;

use Peeghe\Schematic\Schema;
use Peeghe\Schematic\Collection;

class Exporter 
{
    private $refs = [];

    function __construct(Schema $schema) {

        $key = $schema::class . ':' . $schema->id;
        $obj = [];

        foreach ($schema as $key => $item) {
            if (($item instanceof Schema) || ($item instanceof Collection)) {

                continue;
            }
        }
        
    }

    private function walk(Schema $schema) {

        return ;
    }

    public function exportXML($path) {

    }
}
