<?php

namespace Examples\Lists;

use Trebel\Schematic\Collection;

/**
 * [Description Cars]
 */
class Cars extends Collection {
    public static $type = 'Examples\Schemas\Car';
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
