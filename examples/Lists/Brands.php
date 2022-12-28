<?php

namespace Examples\Lists;

use Trebel\Schematic\Collection;

/**
 * [Description Brands]
 */
class Brands extends Collection {
    public static $type = 'Examples\Fields\Car\Name';
    public static $operators = [
        'Trebel\Operators\Push'
    ];

    /**
     * @param mixed ...$arg
     */
    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
}
