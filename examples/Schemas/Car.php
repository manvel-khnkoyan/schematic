<?php

namespace Examples\Schemas;

use Trebel\Schematic\Schema;

/**
 * [Description Car]
 */
class Car extends Schema {
    /**
     * @param mixed ...$args
     */
    function __construct(...$args) {
        parent::__construct(...$args);
    }

    public static $schema = [
        'Examples\Fields\Car\ID',
        'Examples\Fields\Car\Name',
        'Examples\Fields\Car\Price',
    ];
}
