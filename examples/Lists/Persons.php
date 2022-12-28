<?php

namespace Examples\Lists;

use Trebel\Schematic\Collection;

/**
 * [Description Persons]
 */
class Persons extends Collection {
    public static $type = 'Examples\Schemas\Person';
    public static $operators = [
        'Trebel\Schematic\Operators\Push',
        'Trebel\Schematic\Operators\Pull',
    ];

    /**
     * @param mixed ...$arg
     */
    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
}
